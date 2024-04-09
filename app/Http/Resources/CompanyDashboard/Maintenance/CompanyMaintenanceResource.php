<?php

namespace App\Http\Resources\CompanyDashboard\Maintenance;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyMaintenanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // 'id' => $this->id,
            'code' => $this->code,
            'type_of_malfunction'=>$this->type_of_malfunction,
            'device_type' => $this->device_type,
            'address' => $this->address,
            'street_address'=>$this->street_address,
            'phone_number'=>$this->phone_number,
            'company_status'=>$this->company_status,
            'technical' => $this->technical,
            // 'expected_service_date' => $this->expected_service_date,
            'technical_status' => $this->technical_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
