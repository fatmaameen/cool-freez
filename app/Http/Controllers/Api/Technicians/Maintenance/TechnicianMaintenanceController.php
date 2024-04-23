<?php

namespace App\Http\Controllers\Api\Technicians\Maintenance;

use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Technicians\Maintenance\TechnicianMaintenanceResource;

class TechnicianMaintenanceController extends Controller
{
    public function index($id)
    {
        $maintenances = Maintenance::where('company_status', 'confirmed')
            ->where('technical', $id)
            ->where('technical_status', '!=','completed')
            ->get();

            if(count($maintenances)===0){
                return response()->json([
                   'message' => 'No maintenance found'
                ], 404);
            }else{
                $maintenanceResources = TechnicianMaintenanceResource::collection($maintenances);
                return response()->json($maintenanceResources);
            }
    }

    public function update(Request $request, Maintenance $maintenance)
    {
        $request->validate([
            'technical_status' => ['required'],
        ]);

        try {
            $maintenance->update([
                'technical_status' => $request->technical_status,
            ]);

            // Notification here

            return response()->json(['message' => 'Updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Update failed: ' . $e->getMessage()], 500);
        }
    }
}
