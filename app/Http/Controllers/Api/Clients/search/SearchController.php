<?php

namespace App\Http\Controllers\Api\Clients\search;

use App\Models\review;
use App\Models\pricing;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Models\loadCalculation;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Clients\ordersHistory\loadHistoryResource;
use App\Http\Resources\Api\Clients\ordersHistory\reviewHistoryResource;
use App\Http\Resources\Api\Clients\ordersHistory\pricingHistoryResource;
use App\Http\Resources\Api\Clients\ordersHistory\maintenanceHistoryResource;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'service' =>'required|string',
            'input' =>'required|string',
        ]);
        $table = strtolower($request->service);
        $input = strtoupper($request->input);
        switch ($table) {
            case'maintenance':
                $maintenance = Maintenance::where('code', 'like', '%'. $input. '%')->first();
                $data = maintenanceHistoryResource::make($maintenance);
                break;
            case 'pricing':
                $pricing = pricing::where('code', 'like', '%'. $input. '%')->first();
                $data = pricingHistoryResource::make($pricing);
                break;
            case 'review':
                $review = review::where('code', 'like', '%'. $input. '%')->first();
                $data = reviewHistoryResource::make($review);
                break;
            case 'load calculation':
                $load = loadCalculation::where('code', 'like', '%'. $input. '%')->first();
                $data = loadHistoryResource::make($load);
                break;
            default:
                return response()->json(['message' => 'Invalid Service']);
                // break;
        }
        return response()->json($data);
    }
}
