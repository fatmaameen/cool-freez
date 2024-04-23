<?php

namespace App\Http\Controllers\Api\Clients\pricing;

use App\Helpers\CodeGeneration;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Clients\pricing\pricingRequest;
use App\Models\pricing;
use App\Models\pricingDetail;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    use ImageUploadTrait;
    public function store(pricingRequest $request,$client,$service)
    {
        $data = $request->validated();
        do {
            $code = CodeGeneration::generateCode();
        } while (pricing::where('code', $code)->exists());
        $pricing_info['code'] = $code;
        $pricing_info['client_id'] = $client;
        $pricing_info['service_id'] = $service;
        $pricing = pricing::create($pricing_info);
        foreach ($data as $item) {
            $pdf = $item->file('drawing_of_building');
            $pdf_name = $this->upload($pdf, "pricing_files");
            $new_pricing = new pricingDetail;
            $new_pricing->pricing_id = $pricing->id;
            $new_pricing->building_type = $item['building_type'];
            $new_pricing->floor = $item['floor'];
            $new_pricing->brand = $item['brand'];
            $new_pricing->air_conditioning_type = $item['air_conditioning_type'];
            $new_pricing->drawing_of_building = $pdf_name;
            $new_pricing->save();
        }

        return response()->json(['message' => 'Prices added successfully!'], 201);
    }
}
