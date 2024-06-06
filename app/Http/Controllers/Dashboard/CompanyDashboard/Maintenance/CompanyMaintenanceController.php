<?php

namespace App\Http\Controllers\Dashboard\CompanyDashboard\Maintenance;

use Carbon\Carbon;
use App\Models\technician;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Notifications\newNotify;
use App\Helpers\sendNotification;
use App\Jobs\SendNotificationJob;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\CompanyDashboard\Maintenance\CompanyMaintenanceResource;

class CompanyMaintenanceController extends Controller
{
    public function index($companyId)
    {
        $maintenances = Maintenance::where('company_id', $companyId)
            ->where('technical_status', '!=', 'completed')
            ->get();
        $maintenanceResources = CompanyMaintenanceResource::collection($maintenances);

        return view('CompanyDashboard.company_maintenance/incompleted', compact('maintenanceResources'));
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
            'technical' => 'nullable|integer',
            'technical_status' => 'required',
        ]);

        try {
            // Convert the date format after validation
            $expectedServiceDate = Carbon::createFromFormat('m/d/Y', $request->input('expected_service_date'))->format('Y-m-d');

            // Update the maintenance record
            $maintenance->update([
                'company_status' => $request->input('company_status'),
                'technical_id' => $request->input('technical'),
                'expected_service_date' => $expectedServiceDate,
                'technical_status' => $request->input('technical_status')
            ]);

            // Prepare the success notification
            $notification = [
                'message' => trans('main_trans.editing'),
                'alert-type' => 'success'
            ];

            /*
                App notification
            */
            //stored notification
            $notifyData['message'] = 'You have new maintenance check it now';
            $technician = technician::where('id', $request->input('technical'))->first();
            $technician->notify(new newNotify($notifyData));
            sendNotification::CompanyUpdateMaintenance();
            //fly notification
            $token = $technician->device_token;
            $data['device_token'] = $token;
            $data['title'] = config('app.name');
            $data['body'] = 'You have new maintenance check it now';
            SendNotificationJob::dispatch($data);

            // Redirect back with success notification
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            // Handle exceptions and redirect back with error message
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
