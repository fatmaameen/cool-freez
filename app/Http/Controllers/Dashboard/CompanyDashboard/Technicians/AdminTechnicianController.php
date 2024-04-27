<?php

namespace App\Http\Controllers\Dashboard\CompanyDashboard\Technicians;

use App\Models\technician;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CompanyDashboard\Technician\TechnicianRequest;
use Illuminate\Support\Facades\Config;

class AdminTechnicianController extends Controller
{
    use ImageUploadTrait;
    public function index()
    {
        $technicians = technician::latest()->get();
        return view('CompanyDashboard.technician.technician_list' ,compact('technicians'));
    }

    public function store(TechnicianRequest $request)
    {
        try {
            $data = $request->validated();
            $image = $request->file('image');
            $image = $this->upload($image, 'technicians_images');
            $data['image'] = $image;
            technician::create($data);
            return redirect()->back()->with(['message' => 'Created Successfully']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Something went wrong' . $e->getMessage()]);
        }
    }

    public function update(Request $request, technician $technician)
    {
        try {
            if ($request->has('is_banned')) {
                $request->validate([
                    'is_banned' => ['required', 'boolean'],
                ]);
                $technician->update([
                    'is_banned' => $request->is_banned
                ]);
                return redirect()->back()->with(['message' => 'Successfully updated']);
            };
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'something went wrong' . $e->getMessage()]);
        }
    }

    public function destroy(technician $technician)
    {
        $old_image = $technician->image;
        if ($this->remove($old_image)) {
            $technician->delete();
            return redirect()->back()->with(['message' => 'Successfully deleted']);
        } else {
            return  redirect()->back()->with(['message' => 'Something went wrong']);
        }
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => ['required', 'string'],
        ]);
        $search = $request->search;
        $technicians = technician::where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')->get();
        if ($technicians) {
            return response()->json($technicians);
        } else {
            return response()->json(['Message' => "No Data Found"]);
        }
    }
}
