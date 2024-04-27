<?php

namespace App\Http\Resources\Api\Technicians\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class technicianResource extends JsonResource
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
            'name' => $this->name,
            'email'=>$this->email,
            'phone_number'=>$this->phone_number,
            'image' => $this->address,
        ];
    }
}
