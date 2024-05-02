<?php

namespace App\Http\Controllers\Api\Clients\ordersHistory;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Clients\ordersHistory\loadHistoryResource;
use App\Http\Resources\Api\Clients\ordersHistory\maintenanceHistoryResource;
use App\Http\Resources\Api\Clients\ordersHistory\pricingHistoryResource;
use App\Http\Resources\Api\Clients\ordersHistory\reviewHistoryResource;
use App\Models\loadCalculation;
use App\Models\Maintenance;
use App\Models\pricing;
use App\Models\review;

class HistoryController extends Controller
{
    public function index($id)
    {
        $maintenances = Maintenance::where('client_id', $id)->with('service')->get();
        $pricings = pricing::where('client_id', $id)->with('service')->get();
        $reviews = review::where('client_id', $id)->get();
        $loads = loadCalculation::where('client_id', $id)->with('service')->get();

        $maintenances = maintenanceHistoryResource::collection($maintenances);
        $pricings = pricingHistoryResource::collection($pricings);
        $reviews = reviewHistoryResource::collection($reviews);
        $loads = loadHistoryResource::collection($loads);

        $mergedData = [];
        foreach ($maintenances as $maintenance) {
            $mergedData[] =  $maintenance;
        }
        foreach ($pricings as $pricing) {
            $mergedData[] = $pricing;
        }
        foreach ($reviews as $review) {
            $mergedData[] = $review;
        }
        foreach ($loads as $load) {
            $mergedData[] = $load;
        }

        usort($mergedData, function ($a, $b) {
            return strcmp($b->created_at, $a->created_at);
        });

        return response()->json($mergedData);
    }
}
