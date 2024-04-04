<?php

namespace App\Http\Controllers\MainDashboard\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainDashboard\users\AddUserRequest;
use App\Http\Requests\MainDashboard\users\UpdateUserRequest;
use App\Http\Resources\MainDashboard\users\UserInfoResource;
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
        return response()->json($users);
    }
    /**
     * Show Admin Info.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        // return response()->json($user);
        return UserInfoResource::make($user);
    }

    /**
     * Store a newly created Admin.
     */
    public function store(AddUserRequest $request)
    {
        try {
            $data = $request->validated();
            $user = User::create($data);
            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    /**
     * Admin Update His Info.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if ($request->has('image')) {
            $img = $user->image;
            $imagePath = public_path('users_images/' . $img);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $new_image = $request->file('image');
            $image_name = time() . $new_image->getClientOriginalName();
            $new_image->move(public_path('users_images'), $image_name);
            $user->update([
                'image' => $image_name,
            ]);
        };

        if ($request->has('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        };

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number
        ]);
        return response()->json(['message' => 'user updated successfully']);
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
    public function destroy(User $user)
    {
        if (!empty($user->image)) {
            $img = $user->image;
            $imagePath = public_path('users_images/' . $img);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $user->delete();
        return response()->json(['message' => 'user deleted successfully']);
    }
}
