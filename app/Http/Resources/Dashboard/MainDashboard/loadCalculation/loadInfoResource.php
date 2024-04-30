<?php

namespace App\Http\Resources\Dashboard\MainDashboard\loadCalculation;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class loadInfoResource extends JsonResource
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
            'client_id' => $this->client_id,
            'code' => $this->code,
            'model_id' => $this->model_id,
            'client' => [
                'id' => $this->client->id,
                'name' => $this->client->name,
                'email' => $this->client->email,
                'phone_number' => $this->client->phone_number,
                'address' => $this->client->address,
                'image' => $this->client->image,
            ],
            'model' => [
                'id' => $this->model->id,
                'brand' => $this->model->brand,
                'type' => $this->model->type,
                'model' => $this->model->model,
                'btu' => $this->model->btu,
                'cfm' => $this->model->cfm,
                'gas' => $this->model->gas,
                'made_in' => $this->model->made_in,
            ],
        ];
    }
}
