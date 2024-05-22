<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\Admins;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use App\Traits\ImageUploadTrait;
use App\Http\Requests\Dashboard\MainDashboard\admins\AddAdminRequest;
use App\Http\Requests\Dashboard\MainDashboard\admins\UpdateAdminRequest;
use App\Http\Resources\Dashboard\MainDashboard\admins\AdminInfoResource;
use App\Models\company;
use Illuminate\Support\Facades\Auth;

class AdminsController extends Controller
{
    use ImageUploadTrait;
    protected $appUrl;
    public function __construct()
    {
        $this->appUrl = Config::get('app.url');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('MainDashboard.users.profile', compact('user'));
    }

    public function index()
    {
        $users = User::whereNull('company_id')->get();
        $roles = Role::all();
        return view('MainDashboard.users.user_list', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        try {
            $customMessages = [
                'role_id.integer' => 'Please select a valid role.',
            ];

            $data = $request->validate([
                'name' => ['required', 'string', 'max:250','min:2'],
                'role_id' => ['required', 'integer'],
                'email' => ['required', 'email', 'unique:App\Models\User,email'],
                'password' => ['required', 'nullable', 'string', 'max:250'],
                'phone_number' => ['required', 'unique:App\Models\User,phone_number'],
                'image' => ['required', 'image', 'mimes:jpg,bmp,png,jpeg'],
            ], $customMessages);

            $image = $request->file('image');
            $image = $this->upload($image, 'admins_images');
            $data['image'] = $image;

            $user = User::create($data);

            return response()->json(['success' => true, 'message' => 'Created Successfully', 'user' => $user], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Admin Update His Info.
     */
    public function update(UpdateAdminRequest $request, User $admin)
    {
        if ($request->has('image')) {
            $old_image = $admin->image;
            $image = $request->file('image');
            if ($old_image == $this->appUrl . '/' . 'defaults_images' . '/' . 'image.png') {
                $image_name = $this->upload($image, 'admins_images');
                $admin->update([
                    'image' => $image_name,
                ]);
            } else {
                if ($this->remove($old_image)) {
                    $image_name = $this->upload($image, 'admins_images');
                    $admin->update([
                        'image' => $image_name,
                    ]);
                }
            }
        };

        if ($request->has('password')) {
            $admin->update([
                'password' => Hash::make($request->password),
            ]);
        };

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number
        ]);
        $notification = array(
            'message' => trans('main_trans.editing'),
            'alert-type' => 'success'
        );


        return redirect()->back()->with($notification);
    }

    /**
     * SuperAdmin Update Admin.
     */
    public function updateRole(Request $request, User $admin)
    {
        if ($request->has('role_id')) {
            $admin->update([
                'role_id' => $request->role_id
            ]);

            // Return JSON response with alert type and message
            return response()->json([
                'message' => trans('main_trans.editing'),
                'alertType' => 'success'
            ]);
        }
    }


    /**
     * SuperAdmin Remove Admin.
     */
    public function destroy(user $admin)
    {
        $old_image = $admin->image;
        if ($old_image == $this->appUrl . '/' . 'defaults_images' . '/' . 'image.png') {
            $admin->delete();

            $notification = array(
                'message' => trans('main_trans.deleting'),
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            if ($this->remove($old_image)) {
                $admin->delete();
                return  redirect()->back()->with(['message' => 'Successfully deleted']);
            } else {
                return  redirect()->back()->with(['message' => 'Something went wrong']);
            }
        }
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => ['required', 'string'],
        ]);
        $search = $request->search;
        $admin = User::where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')->get();
        if ($admin) {
            return response()->json($admin);
        } else {
            return response()->json(['Message' => "No Data Found"]);
        }
    }
}
