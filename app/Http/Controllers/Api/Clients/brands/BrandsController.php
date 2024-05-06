<?php

namespace App\Http\Controllers\Api\Clients\brands;

use App\Http\Controllers\Controller;
use App\Models\brand;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    public function index($appLocale)
    {
        $brands = brand::all();
        $filteredData = [];
        foreach ($brands as $brandRow) {
            $brand = $brandRow->getTranslation('brand', $appLocale);
            $filteredData[] = [
                'id' => $brandRow->id,
                'brand' => $brand,
            ];
        }
        return response()->json($filteredData);
    }
}
