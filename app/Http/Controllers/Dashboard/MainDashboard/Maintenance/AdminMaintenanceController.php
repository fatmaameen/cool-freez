<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\Maintenance;

use App\Models\company;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Notifications\newNotify;
use App\Helpers\sendNotification;
use App\Jobs\SendNotificationJob;
use App\Http\Controllers\Controller;

class AdminMaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::all();
        $companies = company::all();
        return view('MainDashboard.maintenance.maintenance_list', compact('maintenances', 'companies'));
    }
    public function comfirmed()
    {
        $maintenances = Maintenance::where('admin_status' ,'comfirmed')->get();
        $companies = company::all();
        return view('MainDashboard.maintenance.comfirmed_maintenance', compact('maintenances', 'companies'));
    }

    public function new()
    {
        $maintenances = Maintenance::where('admin_status' ,'waiting')->get();
        $companies = company::all();
        return view('MainDashboard.maintenance.new_maintenance', compact('maintenances', 'companies'));
    }

    public function assign(Request $request, Maintenance $maintenance)
    {
        try {
            if ($request->has('company_id')) {
                $maintenance->update([
                    'company_id' => $request->company_id
                ]);
                sendNotification::assignNotify($request->company_id);
                return response()->json(['message' => __('main_trans.successfully_updated')]);
            };
        } catch (\Exception $e) {
            return response()->json(['error' => __('main_trans.something_error') . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Maintenance $maintenance)
    {
        $request->validate([
            'admin_status' => ['required'],
        ]);

        try {
            $maintenance->update([
                'admin_status' => $request->admin_status,
            ]);

            $notification = array(
                'message' => trans('main_trans.editing'),
                'alert-type' => 'success'
            );
            /*
                App notification
            */
            //stored notification
            $notifyData['message'] = 'your maintenance order has been' . ' ' . $request->admin_status;
            $maintenance->client->notify(new newNotify($notifyData));
            //fly notification
            $token = $maintenance->client->device_token;
            $data['device_token'] = $token;
            $data['title'] = config('app.name');
            $data['body'] = 'your maintenance order has been' . ' ' . $request->admin_status;
            SendNotificationJob::dispatch($data);

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            return  redirect()->back()->with(['message' => 'Update failed: ' . $e->getMessage()]);
        }
    }


    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();
        $notification = array(
            'message' => trans('main_trans.deleting'),
          'alert-type' => 'success'
            );
              return redirect()->back()->with($notification);
    }

    public function search($search)
    {
        if ($search != 'null') {
            $search = strtoupper($search);
            $maintenance = Maintenance::where('code', 'LIKE', '%' . $search . '%')->get();
            if ($maintenance) {
                return response()->json($maintenance);
            } else {
                return response()->json(['Message' => "No Data Found"]);
            }
        } elseif ($search === 'null') {
            $maintenances = Maintenance::all();
            return response()->json($maintenances);
        }
    }
}
