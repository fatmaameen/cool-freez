<?php

namespace App\Http\Controllers\Dashboard\CompanyDashboard\Maintenance;
use Carbon\Carbon;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\CompanyDashboard\Maintenance\CompanyMaintenanceResource;
use App\Models\technician;

class CompanyMaintenanceController extends Controller
{
    public function index($companyId)
    {
        $maintenances = Maintenance::where('company_id', $companyId)
        ->where('technical_status', '!=','completed')
        ->get();
        $maintenanceResources = CompanyMaintenanceResource::collection($maintenances);

        return view('CompanyDashboard.company_maintenance/incompleted' ,compact('maintenanceResources'));
    }

    public function completed($companyId)
    {
        $maintenances = Maintenance::where('company_id', $companyId)
        ->where('technical_status', 'completed')->get();
        $maintenanceResources = CompanyMaintenanceResource::collection($maintenances);
        return view('CompanyDashboard.company_maintenance/completed', compact('maintenanceResources'));
    }


    public function update(Request $request, Maintenance $maintenance)
    {
        // Validate the request data first
        $request->validate([
            'expected_service_date' => 'required|date_format:m/d/Y',
            'company_status' => 'required|string',
            'technical' => 'required|integer',
        ]);

        try {
            // Convert the date format after validation
            $expectedServiceDate = Carbon::createFromFormat('m/d/Y', $request->input('expected_service_date'))->format('Y-m-d');

            // Update the maintenance record
            $maintenance->update([
                'company_status' => $request->input('company_status'),
                'technical_id' => $request->input('technical'),
                'expected_service_date' => $expectedServiceDate,
            ]);

            // Prepare the success notification
            $notification = [
                'message' => trans('main_trans.editing'),
                'alert-type' => 'success'
            ];

            // Redirect back with success notification
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            // Handle exceptions and redirect back with error message
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


}
