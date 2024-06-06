<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Models\technician;
use App\Models\TechnicianRate;
use Illuminate\Http\Request;

class TechnicianRateController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'technician_id' => 'required|exists:technicians,id',
            'rate' => 'required|numeric|min:0|max:5',
        ]);

        TechnicianRate::create($data);
        $technicianRate = TechnicianRate::where('technician_id', $data['technician_id'])->avg('rate');
        $technician = technician::where('id', $data['technician_id'])->first();
        $technician->rate = $technicianRate;
        $technician->save();
        return response()->json(['message' => 'Created successfully']);
    }
}
