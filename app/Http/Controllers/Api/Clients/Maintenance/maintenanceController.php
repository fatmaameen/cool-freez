<?php

namespace App\Http\Controllers\Api\Clients\Maintenance;

use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Clients\Maintenance\MaintenanceRequest;
use App\Helpers\CodeGeneration;
use App\Helpers\sendNotification;
use App\Http\Resources\Api\Clients\Maintenance\MaintenanceTrack;

class maintenanceController extends Controller
{
    public function store(MaintenanceRequest $request)
    {
        try {
            $data = $request->validated();
            do {
                $code = CodeGeneration::generateCode();
            } while (Maintenance::where('code', $code)->exists());
            $data['code'] = $code;
            $newRow = Maintenance::create($data);
            sendNotification::serviceNotify($newRow);
            return response()->json(['message' => 'Created successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error adding maintenance'. $e->getMessage()], 500);
        }
    }

    public function show(string $id)
    {
        $maintenance = Maintenance::find($id);

        $status = $maintenance->technical_status;
        $info = MaintenanceTrack::make($maintenance);
        switch ($status) {
            case 'pending':
                return response()->json(['message' => 'pending', 'data' => $info]);
                // break;
            case 'confirmed':
                return response()->json(['message' => 'confirmed', 'data' => $info]);
                // break;
            case 'out to service':
                return response()->json(['message' => 'out to service', 'data' => $info]);
                // break;
            case 'completed':
                return response()->json(['message' => 'completed', 'data' => $info]);
                // break;
            default:
        }
    }
}
