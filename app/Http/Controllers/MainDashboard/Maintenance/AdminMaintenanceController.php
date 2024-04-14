<?php

namespace App\Http\Controllers\MainDashboard\Maintenance;

use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminMaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::all();
        return response()->json($maintenances);
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

            // Notification here

            return response()->json(['message' => 'Updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Update failed: ' . $e->getMessage()], 500);
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

            return response()->json(['message' => 'Updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Update failed: ' . $e->getMessage()], 500);
        }
    }


    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
