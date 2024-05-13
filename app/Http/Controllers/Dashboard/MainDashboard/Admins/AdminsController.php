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

    public function profile()
    {
        $user = Auth::user();
        return view('MainDashboard.users.profile', compact('user'));
    }

    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('MainDashboard.users.user_list', compact('users', 'roles'));
    }

    public function store(AddAdminRequest $request)
    {
        try {
            $data = $request->validated();
            $image = $request->file('image');
            $image = $this->upload($image, 'admins_images');
            $data['image'] = $image;
            User::create($data);
            return redirect()->back()->with(['message' => 'Created Successfully']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Something went wrong' . $e->getMessage()]);
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
        return redirect()->back()->with(['message' => 'Successfully updated']);
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
            return  redirect()->back()->with(['message' => 'Successfully deleted']);
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
