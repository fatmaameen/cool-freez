<?php

namespace App\Http\Resources\Api\Clients\ordersHistory;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class pricingHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'client_id' => $this->client_id,
            'service_id' => $this->service_id,
            'admin_status' => $this->admin_status,
            'created_at' => $this->created_at,
            'service' => [
                'service_name' => $this->service->service_name,
            ],
            'details' => $this->whenLoaded('details', function () {
                return $this->details->map(function($detail) {
                    return [
                        'building_type' => $detail->building_type,
                        'floor' => $detail->floor,
                        'brand' => $detail->brand,
                        'air_conditioning_type' => $detail->air_conditioning_type,
                        'drawing_of_building' => $detail->drawing_of_building,
                    ];
                });
            }),
        ];
    }
}
