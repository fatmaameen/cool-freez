<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\Companies;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Traits\ImageUploadTrait;
use App\Http\Requests\Dashboard\MainDashboard\admins\UpdateAdminRequest;
use App\Models\company;

class CompanyAdminsController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        $users = User::whereNotNull('company_id')->with('company')->get();
        $companies = company::all();
        return view('MainDashboard.Companies.companies_admins_list', compact('users', 'companies'));
    }

    public function store(Request $request)
    {
        try {
            $customMessages = [
                'company_id.integer' => 'Please select a valid company.',
            ];

            $data = $request->validate([
                'name' => ['required', 'string', 'max:250'],
                'email' => ['required', 'email', 'unique:App\Models\User,email'],
                'password' => ['required', 'nullable', 'string', 'max:250'],
                'phone_number' => ['required', 'unique:App\Models\User,phone_number'],
                'image' => ['required', 'image', 'mimes:jpg,bmp,png,jpeg'],
                'company_id' => ['required', 'integer'],
            ], $customMessages);

            $image = $request->file('image');
            $image = $this->upload($image, 'admins_images');
            $data['image'] = $image;
            $data['role_id'] = 3;

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
            if ($this->remove($old_image)) {
                $image_name = $this->upload($image, 'admins_images');
                $admin->update([
                    'image' => $image_name,
                ]);
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
            'message' => trans('main_trans.successfully_updated'),
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove Admin.
     */
    public function destroy(user $admin)
    {
        $old_image = $admin->image;
        if ($this->remove($old_image)) {
            $admin->delete();
            $notification = array(
                'message' => trans('main_trans.successfully_deleted'),
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => trans('main_trans.something_error'),
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
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
