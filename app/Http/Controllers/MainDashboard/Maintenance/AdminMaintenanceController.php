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
        return view('maintenance.maintenance_list' ,compact('maintenances'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'admin_status' => ['required'],
        ]);


        try {
            Maintenance::findOrFail($id)->update([
                'admin_status' => $request->admin_status,
                'assigned'=>$request->assigned,
            ]);

            // Notification here

            return redirect()->back()->with(['message' => 'Updated successfully']);
        } catch (\Exception $e) {
            return  redirect()->back()->with(['message' => 'Update failed: ' . $e->getMessage()], 500);
        }
    }


    public function destroy($id)
    {
        Maintenance::find($id)->delete();
        return redirect()->back()->with(['message' => 'Deleted successfully']);
    }
}
