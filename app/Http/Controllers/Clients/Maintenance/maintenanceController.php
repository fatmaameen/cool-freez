<?php

namespace App\Http\Controllers\Clients\Maintenance;

use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Clients\Maintenance\MaintenanceRequest;
use App\Helpers\CodeGeneration;
use App\Http\Resources\Clients\Maintenance\MaintenanceTrack;

class maintenanceController extends Controller
{
    public function store(MaintenanceRequest $request){
        $data = $request->validated();
        do {
            $code = CodeGeneration::generateCode();
        } while (Maintenance::where('code', $code)->exists());
        $data['code'] = $code;
        Maintenance::create($data);
        return response()->json(['message'=>'Created successfully']);
    }

    public function show(string $id){
        $maintenance = Maintenance::find($id);

        $status = $maintenance->admin_status;
        switch ($status){
            case 'waiting':
                return response()->json(['message'=>'waiting']);
                // break;
            case 'confirmed':
                $info = MaintenanceTrack::make($maintenance);
                return response()->json(['message'=>'confirmed','data'=>$info]);
                // break;
            case'cancelled':
                return response()->json(['message'=>'cancelled']);
                // break;
            default:
        }
    }
}
