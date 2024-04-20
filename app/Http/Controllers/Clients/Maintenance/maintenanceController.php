<?php

namespace App\Http\Controllers\Clients\Maintenance;

use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Clients\Maintenance\MaintenanceRequest;
use App\Helpers\CodeGeneration;
use App\Http\Resources\Clients\Maintenance\MaintenanceTrack;
use Illuminate\Support\Facades\Log;

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
            Maintenance::create($data);
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
