<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\Maintenance;

use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\sendNotification;

class AdminMaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::all();
        return view('MainDashboard.maintenance.maintenance_list' ,compact('maintenances'));
    }

    public function assign(Request $request, Maintenance $maintenance)
    {
        $request->validate([
            'assigned' => ['required'],
        ]);

        try {
            $maintenance->update([
                'assigned' => $request->assigned,
            ]);
            sendNotification::assignNotify();
            return response()->json(['message' => 'Updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Update failed: ' . $e->getMessage()], 500);
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

            // Notification here

            return redirect()->back()->with(['message' => 'Updated successfully']);
        } catch (\Exception $e) {
            return  redirect()->back()->with(['message' => 'Update failed: ' . $e->getMessage()]);
        }
    }


    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();
        return redirect()->back()->with(['message' => 'Deleted successfully']);
    }

    public function search($search)
    {
        if ($search!='null') {
            $search = strtoupper($search);
            $maintenance = Maintenance::where('code', 'LIKE', '%' . $search . '%')->get();
            if ($maintenance) {
                return response()->json($maintenance);
            } else {
                return response()->json(['Message' => "No Data Found"]);
            }
        } elseif($search === 'null') {
            $maintenances = Maintenance::all();
            return response()->json($maintenances);
        }
    }
}
