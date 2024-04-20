<?php

namespace App\Http\Controllers\MainDashboard\floors;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainDashboard\floors\floorRequest;
use App\Models\floor;
use Illuminate\Http\Request;

class AdminFloorsController extends Controller
{
    public function index()
    {
        $floors = floor::all();
        return response()->json($floors);
    }

    public function store(floorRequest $request)
    {
        $data = $request->validated();
        floor::create($data);
        return redirect()->back()->with(['message' => 'Successfully added']);
    }

    public function update(floorRequest $request, floor $floor)
    {
        $data = $request->validated();
        $floor->update($data);
        return redirect()->back()->with(['message' => 'Successfully updated']);
    }

    public function destroy(floor $floor)
    {
        $floor->delete();
        return redirect()->back()->with(['message' => 'Successfully deleted']);
    }
}
