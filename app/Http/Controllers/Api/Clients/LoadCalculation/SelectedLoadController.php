<?php

namespace App\Http\Controllers\Api\Clients\LoadCalculation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Clients\LoadCalculation\SelectedLoadRequest;
use App\Models\loadCalculation;
use App\Helpers\CodeGeneration;
use App\Helpers\sendNotification;

class SelectedLoadController extends Controller
{
    public function store(SelectedLoadRequest $request)
    {
        try {
            $data = $request->validated();
            do {
                $code = CodeGeneration::generateCode();
            } while (loadCalculation::where('code', $code)->exists());
            $data['code'] = $code;
            $newRow = loadCalculation::create($data);
            sendNotification::loadNotify($newRow);
            return response()->json(['message' => 'Created successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'something went wrong: ' . $e->getMessage()], 500);
        }
    }
}
