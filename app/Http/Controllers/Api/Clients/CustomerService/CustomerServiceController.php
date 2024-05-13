<?php

namespace App\Http\Controllers\Api\Clients\CustomerService;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Clients\CustomerService\CustomerServiceRequest;
use App\Models\CustomerService;
use App\Helpers\sendNotification;

class CustomerServiceController extends Controller
{
    public function store(CustomerServiceRequest $request){
        try{
            $data = $request->validated();
            CustomerService::create($data);
            sendNotification::customerServiceNotify();
            return response()->json(['message' => 'Created successfully']);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Error adding'. $e->getMessage()], 500);
        }
    }
}
