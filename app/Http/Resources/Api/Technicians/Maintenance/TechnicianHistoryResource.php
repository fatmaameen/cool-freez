<?php

namespace App\Http\Resources\Api\Technicians\Maintenance;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TechnicianHistoryResource extends JsonResource
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
            'type_of_malfunction'=>$this->type_of_malfunction,
            'device_type' => $this->device_type,
            'address' => $this->address,
            'street_address'=>$this->street_address,
            'lat' => $this->lat,
            'long' => $this->long,
            'phone_number'=>$this->phone_number,
            'expected_service_date' => $this->expected_service_date,
            'admin_status' => $this->admin_status,
            'company_status' => $this->company_status,
            'technical_status' => $this->technical_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
