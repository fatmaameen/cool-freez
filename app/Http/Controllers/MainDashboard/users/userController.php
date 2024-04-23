<?php

namespace App\Http\Controllers\MainDashboard\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainDashboard\users\AddUserRequest;
use App\Http\Requests\MainDashboard\users\UpdateUserRequest;
use App\Http\Resources\MainDashboard\users\UserInfoResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{

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
             $image->move(public_path('users_images'), $image_name);
         } else {
             // If no image is provided, set image name to null
             $image_name = null;
         }
       
         // Create a new user instance
         $user = new User();
         $user->name = $validatedData['name'];
         $user->email = $validatedData['email'];
         $user->password = Hash::make($validatedData['password']);
         $user->phone_number=$validatedData['phone'];
         $user->image = $image_name;
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
    $user = User::findOrFail($id);

    // Handle file upload if image is provided
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $image_name = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('users_images'), $image_name);
    } else {
        // If no image is provided, keep the existing image name
        $image_name = $user->image;
    }

    // Update user attributes
    $user->name = $validatedData['name'] ?? $user->name;
    $user->email = $validatedData['email'] ?? $user->email;
    $user->password = isset($validatedData['password']) ? Hash::make($validatedData['password']) : $user->password;
    $user->phone_number = $validatedData['phone'] ?? $user->phone_number;
    $user->image = $image_name;
    $user->role_id = $validatedData['role'] ?? $user->role_id;

    // Save the updated user to the database
    $user->save();

    return redirect()->back()->with(['message' => 'User updated successfully']);
}



    /**
     * SuperAdmin Update Admin.
     */
    public function updateRole(Request $request, User $user)
    {
        if ($request->has('role_id')) {
            $user->update([
                'role_id' => $request->role_id
            ]);
            return response()->json(['message' => 'Role updated successfully']);
        };
    }

    /**
     * SuperAdmin Remove Admin.
     */
    public function destroy($id)
    {
        $user=User::where('id',$id)->delete();

        return redirect()->back()->with(['message' => 'user deleted successfully']);
    }
}
