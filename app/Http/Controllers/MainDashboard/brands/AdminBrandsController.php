<?php

namespace App\Http\Controllers\MainDashboard\brands;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainDashboard\brands\BrandsRequest;
use App\Models\brand;
use Illuminate\Http\Request;

class AdminBrandsController extends Controller
{
    public function index()
    {
        $brands = brand::all();
        return response()->json($brands);
    }

    public function store(BrandsRequest $request)
    {
        $data = $request->validated();
        brand::create($data);
        return response()->json(['message' => 'Successfully added']);
    }

    public function update(BrandsRequest $request, brand $brand)
    {
        $data = $request->validated();
        $brand->update($data);
        return response()->json(['message' => 'Successfully updated']);
    }

    public function destroy(brand $brand)
    {
        $brand->delete();
        return response()->json(['message' => 'Successfully deleted']);
    }
}
