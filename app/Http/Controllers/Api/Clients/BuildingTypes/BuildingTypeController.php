<?php

namespace App\Http\Controllers\Api\Clients\BuildingTypes;

use App\Http\Controllers\Controller;
use App\Models\BuildingType;
use Illuminate\Http\Request;

class BuildingTypeController extends Controller
{
    public function index($appLocale)
    {
        $BuildingTypes = BuildingType::all();
        $filteredData = [];
        foreach ($BuildingTypes as $rowData) {
            $name = $rowData->getTranslation('name', $appLocale);
                $filteredData[] = [
                    'id' => $rowData->id,
                    'name' => $name,
                ];
        }
        return response()->json($filteredData);
    }
}
