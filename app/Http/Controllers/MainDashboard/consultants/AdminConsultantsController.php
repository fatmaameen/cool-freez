<?php

namespace App\Http\Controllers\MainDashboard\consultants;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainDashboard\consultants\ConsultantsRequest;
use App\Http\Requests\MainDashboard\consultants\UpdateConsultantsRequest;
use App\Models\consultant;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Log;

class AdminConsultantsController extends Controller
{
    use ImageUploadTrait;
    public function index()
    {
        $consultants = consultant::all();
        return response()->json($consultants);
    }

    public function store(ConsultantsRequest $request)
    {
        try {
            $data = $request->validated();
            $image_info = $request->file('image');
            $image = $this->upload($image_info, "consultants");
            $data['image'] = $image;
            consultant::create($data);
            return response()->json(['message' => 'Successfully added']);
        } catch (\Exception $e) {
            Log::error("Error adding consultant: " . $e->getMessage());
            return response()->json(['message' => 'Error adding consultant'], 500);
        }
    }

    public function update(UpdateConsultantsRequest $request, consultant $consultant)
    {
        $data = $request->validated();

        if ($request->has('image')) {
            $old_image = $consultant->image;
            if ($this->remove($old_image, 'consultants')) {
                $image_info = $request->file('image');
                $image = $this->upload($image_info, "consultants");
                $consultant->update([
                    'name' => $data['name'],
                    'job_title' => $data['job_title'],
                    'email' => $data['email'],
                    'phone_number' => $data['phone_number'],
                    'image' => $image,
                ]);
                return response()->json(['message' => 'Successfully updated']);
            } else {
                return response()->json(['message' => 'Something went wrong']);
            }
        }else{
            $consultant->update([
                'name' => $data['name'],
                'job_title' => $data['job_title'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
            ]);
            return response()->json(['message' => 'Successfully updated']);
        }
    }

    public function destroy(consultant $consultant)
    {
        $old_image = $consultant->image;
        if ($this->remove($old_image, 'consultants')) {
            $consultant->delete();
            return response()->json(['message' => 'Successfully deleted']);
        } else {
            return response()->json(['message' => 'Something went wrong']);
        }
    }
}
