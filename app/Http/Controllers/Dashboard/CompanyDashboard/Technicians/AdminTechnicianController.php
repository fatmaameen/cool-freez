<?php

namespace App\Http\Controllers\Dashboard\CompanyDashboard\Technicians;

use App\Models\technician;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CompanyDashboard\Technician\TechnicianRequest;
use App\Http\Requests\Dashboard\CompanyDashboard\Technician\UpdateTechnicianRequest as TechnicianUpdateTechnicianRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminTechnicianController extends Controller
{
    use ImageUploadTrait;
    public function index()
    {
        $technicians = technician::latest()->get();
        return view('CompanyDashboard.technician.technician_list', compact('technicians'));
    }
    public function profile()
    {
        $user = Auth::user();
        return view('CompanyDashboard.profile', compact('user'));
    }

    // public function update_user(Request $request, $id)
    // {
    //     // Validate the incoming request data
    //     $validatedData = $request->validate([
    //         'name' => 'nullable|string',
    //         'email' => 'nullable|email|unique:users,email,' . $id,
    //         'password' => 'nullable|string|min:6',
    //         'phone' => 'nullable|string',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'role' => 'nullable|exists:roles,id', // Validate that the role exists in the roles table
    //     ]);

    //     // Fetch the user from the database
    //     $admin = User::findOrFail($id);

    //     // Handle file upload if image is provided
    //     if ($request->hasFile('image')) {
    //         global $new_image;
    //         $image = $request->file('image');
    //         if ($admin->image == $this->appUrl . '/' . 'defaults_images' . '/' . 'image.png') {
    //             $new_image = $this->upload($image, 'admins_images');
    //         } else {
    //             if ($this->remove($admin->image)) {
    //                 $new_image = $this->upload($image, 'admins_images');
    //             }
    //         }
    //     } else {
    //         $new_image = $admin->image;
    //     }
    //     // Update user attributes
    //     $admin->name = $validatedData['name'] ?? $admin->name;
    //     $admin->email = $validatedData['email'] ?? $admin->email;
    //     $admin->password = isset($validatedData['password']) ? Hash::make($validatedData['password']) : $admin->password;
    //     $admin->phone_number = $validatedData['phone'] ?? $admin->phone_number;
    //     $admin->image = $new_image;
    //     $admin->role_id = $validatedData['role'] ?? $admin->role_id;

    //     // Save the updated user to the database
    //     $admin->save();

    //     return redirect()->back()->with(['message' => 'User updated successfully']);
    // }



    public function store(TechnicianRequest $request)
    {
        try {
            $data = $request->validated();
            $image = $request->file('image');
            $image = $this->upload($image, 'technicians_images');
            $data['image'] = $image;
            technician::create($data);
            return redirect()->back()->with(['message' => __('main_trans.successfully_added')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Something went wrong' . $e->getMessage()]);
        }
    }

    public function update(TechnicianUpdateTechnicianRequest $request, Technician $technician)
    {
        $data = $request->validated();
        if ($request->has('image')) {
            $old_image = $technician->image;
            $image = $request->file('image');
            if ($this->remove($old_image)) {
                $image_name = $this->upload($image, 'technicians_images');
                $technician->update([
                    'image' => $image_name,
                ]);
            }
        };

        if ($request->has('password')) {
            $technician->update([
                'password' => Hash::make($request->password),
            ]);
        };

        $technician->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number
        ]);
        return redirect()->back()->with(['message' => __('main_trans.successfully_updated')]);
    }

    public function destroy(technician $technician)
    {
        $old_image = $technician->image;
        if ($this->remove($old_image)) {
            $technician->delete();
            return  redirect()->back()->with(['message' => __('main_trans.successfully_deleted')]);
        } else {
            return  redirect()->back()->with(['message' => 'Something went wrong']);
        }
    }
    public function banned(Request $request, Technician $technician)
    {
        try {
            $request->validate([
                'is_banned' => ['required'],
            ]);

            $technician->update([
                'is_banned' => $request->is_banned,
            ]);

            return response()->json(['message' => 'Updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong' . $e->getMessage()], 500);
        }
    }

    public function search($search)
    {
        if ($search != 'null') {
            $technicians = Technician::where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')->get();
            if ($technicians) {
                return response()->json($technicians);
            } else {
                return response()->json(['Message' => "No Data Found"]);
            }
        } elseif ($search === 'null') {
            $technicians = Technician::all();
            return response()->json($technicians);
        }
    }
}
