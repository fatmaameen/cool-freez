<?php

namespace App\Http\Controllers\Api\Clients\floors;

use App\Http\Controllers\Controller;
use App\Models\UsingFloor;

class floorsController extends Controller
{
    public function index($appLocale)
    {
        $floors = UsingFloor::all();
        $filteredData = [];
        $uniqueUsings = [];
        foreach ($floors as $floorRow) {
            $using = $floorRow->getTranslation('floor', $appLocale);
            if (!in_array($using, $uniqueUsings)) {
                $filteredData[] = [
                    'id' => $floorRow->id,
                    'floor' => $using,
                ];
                $uniqueUsings[] = $using;
            }
        }
        return response()->json($filteredData);
    }
}
