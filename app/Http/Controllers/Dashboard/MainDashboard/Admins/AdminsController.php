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
use Illuminate\Support\Facades\Auth;

class AdminsController extends Controller
{
    use ImageUploadTrait;
    protected $appUrl;
    public function __construct()
    {
        $this->appUrl = Config::get('app.url');
    }
    /**
     * Display a listing of the resource.
     */


    public function profile(){
$user=Auth::user();

        return view('MainDashboard.users.profile',compact('user') );
    }






     public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('MainDashboard.users.user_list' ,compact('users', 'roles'));

    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:50|min:2',
           'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'required|string|max:15', // Assuming phone number is a string and has a maximum length of 15
         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
         'role' => 'required|exists:roles,id', // Assuming role is a foreign key that exists in the roles table
        ]);

        // Handle file upload if image is provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('admins_images'), $image_name);
        } else {
            // If no image is provided, set image name to null
            $image_name = null;
        }
        // Create a new user instance
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->phone_number = $validatedData['phone'];
        $user->image = $this->appUrl . '/' . 'admins_images' . '/' . $image_name;
        $user->role_id = $validatedData['role'];
        //Assign the image name to the user's image attribute

        // Save the user to the database
        $user->save();

        $notification = array(
            'message' => trans('main_trans.adding'),
            'alert-type' => 'success'
             );


        return redirect()->back()->with($notification);

    }

    /**
     * Admin Update His Info.
     */
    public function update(Request $request, $id)
    {

        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'nullable|string|regex:/^[a-zA-Z\s]+$/|max:50|min:2',
            'email' => 'nullable|email|unique:users,email' .$id,
             'password' => 'nullable|string|min:6',
             'phone' => 'nullable|string|max:15', // Assuming phone number is a string and has a maximum length of 15
          'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
          'role' => 'nullable|exists:roles,id', // Assuming role is a foreign key that exists in the roles table
        ]);

        // Fetch the user from the database
        $admin = User::findOrFail($id);

        // Handle file upload if image is provided
        if ($request->hasFile('image')) {
            global $new_image;
            $image = $request->file('image');
            if ($admin->image == $this->appUrl . '/' . 'defaults_images' . '/' . 'image.png') {
                $new_image = $this->upload($image, 'admins_images');
            } else{
                if ($this->remove($admin->image)) {
                    $new_image = $this->upload($image, 'admins_images');
                }
            }
        } else {
            $new_image = $admin->image;
        }
        // Update user attributes
        $admin->name = $validatedData['name'] ?? $admin->name;
        $admin->email = $validatedData['email'] ?? $admin->email;
        $admin->password = isset($validatedData['password']) ? Hash::make($validatedData['password']) : $admin->password;
        $admin->phone_number = $validatedData['phone'] ?? $admin->phone_number;
        $admin->image = $new_image;
        $admin->role_id = $validatedData['role'] ?? $admin->role_id;

        // Save the updated user to the database
        $admin->save();

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
            return response()->json(['message' => 'Successfully updated']);
        };
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
        'alert-type' => 'error'
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
}
