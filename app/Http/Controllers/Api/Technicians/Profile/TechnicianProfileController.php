<?php

namespace App\Http\Controllers\Api\Technicians\Profile;

use App\Models\technician;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Technicians\profile\UpdateTechnicianRequest;
use Illuminate\Support\Facades\Hash;
use App\Traits\ImageUploadTrait;
use App\Http\Resources\Api\Technicians\Auth\technicianResource;

class TechnicianProfileController extends Controller
{
    use ImageUploadTrait;
    public function show(technician $technician)
    {
        return technicianResource::make($technician);
    }

    public function update(UpdateTechnicianRequest $request, technician $technician)
    {
        if ($request->has('image')) {
            $old_image = $technician->image;
            $image = $request->file('image'); {
                if ($this->remove($old_image)) {
                    $image_name = $this->upload($image, 'technicians_images');
                    $technician->update([
                        'image' => $image_name,
                    ]);
                } else {
                    return  response()->json(['message' => 'Something went wrong']);
                }
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
        return response()->json(['message' => 'Successfully updated']);
    }

    public function add_device_token(Request $request, technician $technician)
    {
        $request->validate([
            'device_token' => 'required|string'
        ]);
        $technician->update([
            'device_token' => $request->device_token
        ]);
        return response()->json(['message' => 'Successfully updated']);
    }
}
