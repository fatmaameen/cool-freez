<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\LoadCalculation;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\MainDashboard\loadCalculation\loadInfoResource;
use App\Models\loadCalculation;
use Illuminate\Http\Request;

class AdminLoadCalculationsController extends Controller
{
    public function index()
    {
        $loads = loadCalculation::latest()->get();
        return view('MainDashboard.loadCalculation.loadCalculation_list' ,compact('loads'));
    }

    public function show($id)
    {
        $load = loadCalculation::where('id', $id)->with(['client','model'])->first();
        $data = loadInfoResource::make($load);
         return view('MainDashboard.loadCalculation.details' ,compact('data'));
        //return response()->json($data);
    }

    public function update(Request $request, loadCalculation $load)
    {
        $request->validate([
            'admin_status' => ['required'],
        ]);

        try {
            $load->update([
                'admin_status' => $request->admin_status,
            ]);

            // Notification here

            return redirect()->back()->with(['message' => 'updated successfully']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }
    public function destroy(loadCalculation $load)
    {
        $load->delete();
        return redirect()->back()->with(['message' => 'deleted successfully']);
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => ['required', 'string'],
        ]);
        $search = $request->search;
        $load = loadCalculation::where('code', 'LIKE', '%' . $search . '%')->first();
        if ($load) {
            return response()->json($load);
        } else {
            return response()->json(['Message' => "No Data Found"]);
        }
    }
}
