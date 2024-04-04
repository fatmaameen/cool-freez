<?php

namespace App\Http\Controllers\Clients;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Clients\AddNewClientRequest;
use App\Http\Requests\Clients\UpdateClientRequest;
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
        $token = $client->createToken('auth_token')->plainTextToken;
        return response()->json(['token' => $token], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $client = Client::where('email', $request->email)->first();

        if (!$client || !Hash::check($request->password, $client->password)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $token = $client->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token,'message'=>'LogedIn Successfully'], 200);
    }

    public function googleLogin(Request $request){

    }

    public function logout($id){
        $client = Client::findOrFail($id)->first();
        $client->tokens()->delete();
        return response()->json(['message' => 'Successfully Logout'], 200);
    }

    public function show(string $id)
    {
        $client = Client::find($id);
        return ClientInfoResource::make($client);
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        if ($request->has('image')) {
            $img = $client->image;
            $imagePath = public_path('clients_images/' . $img);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $new_image = $request->file('image');
            $image_name = time() . $new_image->getClientOriginalName();
            $new_image->move(public_path('clients_images'), $image_name);
            $client->update([
                'image' => $image_name,
            ]);
        };

        if ($request->has('password')) {
            $client->update([
                'password' => Hash::make($request->password),
            ]);
        };

        $client->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number
        ]);
        return response()->json(['message' => 'client updated successfully'], 200);
    }

    public function destroy(Client $client){
        $img = $client->image;
        $imagePath = public_path('clients_images/' . $img);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $client->delete();
        return response()->json(['message' => 'client deleted successfully'], 200);
    }
}
