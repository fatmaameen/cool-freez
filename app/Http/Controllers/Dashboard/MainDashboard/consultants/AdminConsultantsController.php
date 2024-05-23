<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\consultants;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\MainDashboard\consultants\ConsultantsRequest;
use App\Http\Requests\Dashboard\MainDashboard\consultants\UpdateConsultantsRequest;
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

        return view('MainDashboard.consultants.consultant_list' ,compact('consultants'));
    }

    public function store(ConsultantsRequest $request)
    {

        try {

            $data = $request->validated();
            $image_info = $request->file('image');
            $image = $this->upload($image_info, 'consultants');
            $data['image'] = $image;
            
           $consultant= consultant::create($data);

           return response()->json(['success' => true, 'message' => 'Created Successfully', 'consultant' => $consultant], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['success' => false,'error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }

    }

    public function update(UpdateConsultantsRequest $request, consultant $consultant)
    {
        $data = $request->validated();

        if ($request->has('image')) {
            $old_image = $consultant->image;
            if ($this->remove($old_image)) {
                $image_info = $request->file('image');
                $image = $this->upload($image_info, "consultants");
                $consultant->update([
                    'name' => $data['name'],
                    'job_title' => $data['job_title'],
                    'email' => $data['email'],
                    'phone_number' => $data['phone_number'],
                    'image' => $image,
                    'rate'=>$data['rate']
                ]);
                $notification = array(
                    'message' => trans('main_trans.editing'),
                    'alert-type' => 'success'
                     );


                return redirect()->back()->with($notification);
            } else {
                return  redirect()->back()->with(['message' => 'Something went wrong']);
            }
        }else{
            $consultant->update([
                'name' => $data['name'],
                'job_title' => $data['job_title'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                 'rate'=>$data['rate']
            ]);
            $notification = array(
                'message' => trans('main_trans.editing'),
              'alert-type' => 'success'
                );
                  return redirect()->back()->with($notification);
        }
    }

    public function destroy(consultant $consultant)
    {
        $old_image = $consultant->image;
        if ($this->remove($old_image)) {
            $consultant->delete();
            $notification = array(
                'message' => trans('main_trans.deleting'),
              'alert-type' => 'error'
                );
                  return redirect()->back()->with($notification);           } else {
            return  redirect()->back()->with(['message' => 'Something went wrong']);
        }
    }
}
