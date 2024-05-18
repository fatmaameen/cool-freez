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
    $expectedServiceDate = Carbon::createFromFormat('d-m-Y', $request->input('expected_service_date'))->format('Y-m-d');
    try {
        $maintenance->update([
            'company_status' => $request->input('company_status'),
            'technical_id' => $request->input('technical'),
            'expected_service_date' => $expectedServiceDate,
        ]);

        $notification = array(
            'message' => trans('main_trans.editing'),
            'alert-type' => 'success'
             );

        return redirect()->back()->with($notification);
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Update failed: ' . $e->getMessage());
    }
}
}
