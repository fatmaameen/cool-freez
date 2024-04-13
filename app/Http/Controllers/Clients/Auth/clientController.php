<?php

namespace App\Http\Controllers\Clients\Auth;

use App\Mail\mailer;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Helpers\TwilioHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Clients\AddNewClientRequest;
use App\Http\Resources\Clients\ClientInfoResource;

class clientController extends Controller
{
    public function register(AddNewClientRequest $request)
    {
        $data = $request->validated();
        $client = Client::create($data);
        if ($request->has('image')) {
            $new_image = $request->file('image');
            $image_name = time() . $new_image->getClientOriginalName();
            $new_image->move(public_path('clients_images'), $image_name);
            $client->update([
                'image' => $image_name,
            ]);
        };
        $token = $client->createToken('auth_token', ['server:update'])->plainTextToken;
        return response()->json(['token' => $token,'message'=>'Successfully registered']);
    }

    public function login(Request $request)
    {
        $method = $request->get('method');
        switch ($method) {
            case 'email':
                $request->validate([
                    'email' => 'required|string|email',
                    'password' => 'required|string',
                ]);

                $client = Client::where('email', $request->email)->first();
                if (!$client || $client->is_banned) {
                    return response()->json(['message' => 'Your account is banned']);
                }

                if (!$client || !Hash::check($request->password, $client->password)) {
                    return response()->json(['message' => 'Incorrect Email or Password']);
                }

                $token = $client->createToken('auth_token', ['server:update'])->plainTextToken;
                $client_info = ClientInfoResource::make($client);
                return response()->json(['token' => $token,'message'=>'Logged in successfully','client'=>$client_info]);
                break;
                case 'firebase':
                    $request->validate([
                        'uid' => 'required',
                    ]);
                    $uid = $request->get('uid');
                    try {
                        $auth = app('firebase.auth');
                        $firebaseUser = $auth->getUser($uid);

                        $email = $firebaseUser->email;
                        $phone = $firebaseUser->phone_number;

                        if(!empty($email)){
                            $client = Client::firstOrCreate(['email' => $email]);
                            if ($client->is_banned) {
                                return response()->json(['message' => 'Your account is banned']);
                            }

                            $token = $client->createToken('auth_token', ['server:update'])->plainTextToken;

                            return response()->json(['token' => $token,'message'=>'Logged in successfully']);

                        }else if(!empty($phone)){
                            $client = Client::where(['phone_number' => $phone]);

                            if(!empty($client)){
                                if ($client->is_banned) {
                                    return response()->json(['message' => 'Your account is banned']);
                                }

                                $token = $client->createToken('auth_token', ['server:update'])->plainTextToken;

                                return response()->json(['token' => $token,'message'=>'Logged in successfully']);
                            }else{
                                return response()->json(['message' => 'Not registered client']);
                            }
                        }

                    } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
                        return response()->json([
                            'message' => 'User Not Found'
                        ]);
                    }
                    default:
                    return response()->json([
                        'message' => 'Invalid Login Method'
                    ]);
        };
    }

    public function logout($id){
        $client = Client::findOrFail($id)->first();
        $client->tokens()->delete();
        return response()->json(['message' => 'Successfully Logout']);
    }

    public function searchByMail(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        $email = $request->email;
        $client = Client::where(['email' => $email])->first();
        if ($client) {
            $code = str_pad(mt_rand(111111, 999999), 6, '0', STR_PAD_LEFT);
            $client->email_confirmation_token = $code;
            try {
                $client->save();
            } catch (\Exception $e) {
                return response()->json(['message' => false, 'error' => $e->getMessage()]);
            }
            $data['subject'] = 'Verification Code';
            $data['title'] = $code;
            $data['message'] = 'this is your Verification code';
            Mail::to($email)->send(new mailer($data));
            return response()->json(['message' => true]);
        } else {
            return response()->json(['message' => false]);
        }
    }

    public function checkCode(Request $request)
    {
        $request->validate([
            'email' =>'required|string|email',
            'code' =>'required|string',
        ]);
        $email = $request->email;
        $code = $request->code;
        $client = Client::where(['email' => $email])->first();
        if ($client->email_confirmation_token == $code) {
            return response()->json(['message' => true]);
        } else {
            return response()->json(['message' => false]);
        }
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8',
            'email' =>'required|string|email',
        ]);
        $email = $request->email;
        $client = Client::where(['email' => $email])->first();
        $client->email_confirmation_token = null;
        $client->password = Hash::make($request->password);
        $client->save();
        return response()->json(['message' => 'password updated successfully']);
    }

    public function sendOTP(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string',
        ]);
        $phone_number = $request->phone_number;
        $otp = rand(1111, 9999);
        $client = Client::where(['phone_number' => $phone_number])->first();
        if (!$client) {
            Client::create([
                'phone_number' => $phone_number,
                'phone_confirmation_token' => $$otp
            ]);
            $otp = "1111";
            $sent = TwilioHelper::sendOTP($phone_number, $otp);
            if ($sent) {
                return response()->json(['message' => 'OTP sent successfully']);
            } else {
                return response()->json(['error' => 'Failed to send OTP'], 500);
            }
        }else{
            return response()->json(['error' => 'number already register'], 500);
        }
    }

    public function checkOTP(Request $request)
    {
        $request->validate([
            'phone_number' =>'required|string',
            'OTP' =>'required|string',
        ]);
        $OTP = $request->OTP;
        $phone_number = $request->phone_number;
        $client = Client::where(['phone_number' => $phone_number])->first();
        if ($client->phone_confirmation_token == $OTP){;
        } else {
            return response()->json(['message' => false]);
        }
    }
}
