<?php

namespace App\Http\Controllers\Api\Technicians\Maintenance;

use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Notifications\newNotify;
use App\Jobs\SendNotificationJob;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Technicians\Maintenance\TechnicianHistoryResource;
use App\Http\Resources\Api\Technicians\Maintenance\TechnicianMaintenanceResource;

class TechnicianMaintenanceController extends Controller
{
    public function index($id)
    {
        $maintenances = Maintenance::where('company_status', 'confirmed')
            ->where('admin_status','confirmed')
            ->where('technical_id', $id)
            ->where('technical_status', '!=', 'completed')
            ->get();

        if (count($maintenances) === 0) {
            return response()->json([
                'message' => 'No maintenance found'
            ], 404);
        } else {
            $maintenanceResources = TechnicianMaintenanceResource::collection($maintenances);
            return response()->json($maintenanceResources);
        }
    }

    public function history($id)
    {
        $maintenances = Maintenance::where('technical_id', $id)
        ->where('admin_status','!=','waiting')
        ->where('company_status', '!=', 'pending')
        ->get();

        if (count($maintenances) === 0) {
            return response()->json([
                'message' => 'No maintenance found'
            ], 404);
        } else {
            $maintenanceResources = TechnicianHistoryResource::collection($maintenances);
            $sortedData = [];
            foreach ($maintenanceResources as $maintenance) {
                $sortedData[] =  $maintenance;
            }
            usort($sortedData, function ($a, $b) {
                return strcmp($b->created_at, $a->created_at);
            });
            return response()->json($sortedData);
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

            /*
                App notification
            */
            //stored notification
            $notifyData['message'] = 'your maintenance order has been' . ' ' . $request->technical_status;
            $maintenance->client->notify(new newNotify($notifyData));
            //fly notification
            $token = $maintenance->client->device_token;
            $data['device_token'] = $token;
            $data['title'] = config('app.name');
            $data['body'] = 'your maintenance order has been' . ' ' . $request->technical_status;
            SendNotificationJob::dispatch($data);

            return response()->json(['message' => 'Updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Update failed: ' . $e->getMessage()], 500);
        }
    }
}
