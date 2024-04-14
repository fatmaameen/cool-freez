<?php

namespace App\Http\Controllers\CompanyDashboard\Maintenance;

use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyDashboard\Maintenance\CompanyMaintenanceResource;

class CompanyMaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::where('assigned', true)
        ->where('technical_status', '!=','completed')
        ->get();
        $maintenanceResources = CompanyMaintenanceResource::collection($maintenances);
        return view('company_maintenance/incompleted' ,compact('maintenanceResources'));
    }

    public function completed()
    {
        $maintenances = Maintenance::where('technical_status', 'completed')->get();
        $maintenanceResources = CompanyMaintenanceResource::collection($maintenances);
        return view('company_maintenance/completed', compact('maintenanceResources'));
    }

    public function update(Request $request, $id)
    {
        return $request;
        // $request->validate([
        //     'company_status' => ['required'],
        //     'technical' => ['required'],
        //     'expected_service_date' => ['required'],
        // ]);

        // try {
        //     Maintenance::find($id)->update([
        //         'company_status' => $request->company_status,
        //         'technical' => $request->technical,
        //         'expected_service_date' => $request->expected_service_date,
        //     ]);

        //     // Notification here

        //     return redirect()->back()->with(['message' => 'Updated successfully']);
        // } catch (\Exception $e) {
        //     return response()->json(['message' => 'Update failed: ' . $e->getMessage()], 500);
        // }
    }
}
