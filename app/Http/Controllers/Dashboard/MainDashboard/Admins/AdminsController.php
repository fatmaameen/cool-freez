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

class AdminsController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $roles=Role::all();
        return view('users.user_list', compact('users','roles'));
        //return response()->json($users);
    }
    /**
     * Show Admin Info.
     */
    // public function show(string $id)
    // {
    //     $user = User::find($id);
    //     // return response()->json($user);
    //     return UserInfoResource::make($user);
    // }

    /**
     * Store a newly created Admin.
     */

     public function store(Request $request)
     {
         // Validate the incoming request data
         $validatedData = $request->validate([
             'name' => 'required|string',
             'email' => 'required|email|unique:users,email',
             'password' => 'required|string|min:6',
             'phone'=>'required',
             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
             'role'=>'required'
             // Adjust the file size limit as needed
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
         $appUrl = Config::get('app.url');
         // Create a new user instance
         $user = new User();
         $user->name = $validatedData['name'];
         $user->email = $validatedData['email'];
         $user->password = Hash::make($validatedData['password']);
         $user->phone_number=$validatedData['phone'];
         $user->image = $appUrl.'/'.'admins_images'.'/'.$image_name;
         $user->role_id=$validatedData['role'];
         //Assign the image name to the user's image attribute

         // Save the user to the database
         $user->save();

         return redirect()->back()->with(['message' => 'User created successfully']);
     }

    /**
     * Admin Update His Info.
     */
    public function update(Request $request, $id)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'name' => 'nullable|string',
        'email' => 'nullable|email|unique:users,email,' . $id,
        'password' => 'nullable|string|min:6',
        'phone' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'role' => 'nullable|exists:roles,id', // Validate that the role exists in the roles table
    ]);

    // Fetch the user from the database
    $admin = User::findOrFail($id);

    // Handle file upload if image is provided
    if ($request->hasFile('image')) {
        global $new_image;
        if ($this->remove($admin->image)) {
            $image = $request->file('image');
            $new_image = $this->upload($image, 'admins_images');
        }
    } else {
        // If no image is provided, keep the existing image name
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

    return redirect()->back()->with(['message' => 'User updated successfully']);
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
        if ($this->remove($old_image)) {
            $admin->delete();
            return  redirect()->back()->with(['message' => 'Successfully deleted']);
        } else {
            return  redirect()->back()->with(['message' => 'Something went wrong']);
        }
    }
}
