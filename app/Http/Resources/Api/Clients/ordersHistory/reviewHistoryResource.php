<?php

namespace App\Http\Resources\Api\Clients\ordersHistory;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class reviewHistoryResource extends JsonResource
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
            'consultant_id'=>$this->consultant_id,
            'admin_status' => $this->admin_status,
            'created_at' => $this->created_at,
            'service' => [
                'service_name' => $this->service->service_name,
            ],
        ];
    }
}
