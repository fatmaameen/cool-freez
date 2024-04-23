<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\brands;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\MainDashboard\brands\BrandsRequest;
use App\Models\brand;
use Illuminate\Http\Request;

class AdminBrandsController extends Controller
{
    public function index()
    {
        $brands = brand::all();
        return view('brands/brand_list' ,compact('brands'));
    }

    public function store(BrandsRequest $request)
    {
        $data = $request->validated();
        brand::create($data);
        return redirect()->back()->with(['message' => 'Successfully added']);
    }

    public function update(BrandsRequest $request, brand $brand)
    {
        $data = $request->validated();
        $brand->update($data);
        return redirect()->back()->with(['message' => 'Successfully updated']);
    }

    public function destroy(brand $brand)
    {
        $brand->delete();
        return redirect()->back()->with(['message' => 'Successfully deleted']);
    }
}
