<?php

namespace App\Http\Controllers\Api\Clients\pricing;

use App\Helpers\CodeGeneration;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Clients\pricing\pricingRequest;
use App\Models\pricing;
use App\Models\pricingDetail;
use App\Helpers\sendNotification;
use App\Traits\PDFUploadTrait;

class PricingController extends Controller
{
    use PDFUploadTrait;
    public function store(pricingRequest $request, $client, $service)
    {
        try {
            $data = $request->validated();
            $length = count($data['building_type']);
            foreach ($data as $item) {
                if (count($item) !== $length) {
                    return response()->json(['message' => 'Not completed data']);
                }
            }

            do {
                $code = CodeGeneration::generateCode();
            } while (pricing::where('code', $code)->exists());

            $pricing_info['code'] = $code;
            $pricing_info['client_id'] = $client;
            $pricing_info['service_id'] = $service;
            $pdf = $request->file('drawing_of_building');
            $pdf_names = $this->uploadPDF($pdf, "pricing_files");
            $pricing_info['drawing_of_building'] = json_encode($pdf_names);;
            $pricing = pricing::create($pricing_info);

            for ($i = 0; $i < $length; $i++) {
                $new_pricing = new pricingDetail();
                $new_pricing->pricing_id = $pricing->id;
                $new_pricing->building_type = $data['building_type'][$i];
                $new_pricing->floor = $data['floor'][$i];
                $new_pricing->brand = $data['brand'][$i];
                $new_pricing->air_conditioning_type = $data['air_conditioning_type'][$i];
                $new_pricing->save();
            }
            sendNotification::serviceNotify($pricing);
            return response()->json(['message' => 'Created successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'something went wrong' . $e->getMessage()]);
        }
    }
}
