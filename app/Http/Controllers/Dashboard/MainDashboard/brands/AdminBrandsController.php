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
        $appLocale = app()->getLocale();
        $brands = brand::all();
        $filteredData = [];
        foreach ($brands as $brand) {
            $rowData = $brand->getTranslation('brand', $appLocale);
            $brand_en = $brand->getTranslation('brand', 'en');
            $brand_ar = $brand->getTranslation('brand', 'ar');
            $filteredData[] = [
                'id' => $brand->id,
                'brand' => $rowData,
                'brand_en' => $brand_en,
                'brand_ar' => $brand_ar,
            ];
        }
        return view('MainDashboard.brands/brand_list', compact('filteredData'));
    }

    public function store(BrandsRequest $request)
    {
        $data = $request->validated();
        $brand = new brand();
        $brand
            ->setTranslation('brand', 'en', strtolower($data['brand_en']))
            ->setTranslation('brand', 'ar', $data['brand_ar']);
        $brand->save();

        $notification = array(
            'message' => trans('main_trans.adding'),
            'alert-type' => 'success'
             );


        return redirect()->back()->with($notification);
    }

    public function update(BrandsRequest $request, brand $brand)
    {
        $data = $request->validated();
        $brand
            ->setTranslation('brand', 'en', strtolower($data['brand_en']))
            ->setTranslation('brand', 'ar', $data['brand_ar']);
        $brand->save();
        $notification = array(
            'message' => trans('main_trans.editing'),
            'alert-type' => 'error'
             );


        return redirect()->back()->with($notification);
    }

    public function destroy(brand $brand)
    {
        $brand->delete();
        $notification = array(
            'message' => trans('main_trans.deleting'),
          'alert-type' => 'success'
            );
              return redirect()->back()->with($notification);
    }
}
