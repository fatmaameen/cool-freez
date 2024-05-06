<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\cfmRates;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\MainDashboard\cfmRates\cfmRatesRequest;
use App\Models\cfmRate;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class AdminCfmRatesController extends Controller
{
    public function index()
    {
        $data = cfmRate::all();

        return view('MainDashboard.cfmRate.cfmRate_list' ,compact('data'));
    }

    public function update(cfmRatesRequest $request, cfmRate $rate)
    {
        try {
            $data = $request->Validated();
            $rate->update($data);
            return redirect()->back()->with(['message' => 'updated successfully']);
        } catch (\Exception $e) {
            return  redirect()->back()->with(['message' => 'something went wrong', 'errors' => $e->getMessage()]);
        }
    }
}
