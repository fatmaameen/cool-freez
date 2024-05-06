<?php

namespace App\Http\Controllers\Api\Clients\types;

use App\Http\Controllers\Controller;
use App\Models\type;
use Illuminate\Http\Request;

class TypesController extends Controller
{
    public function index($appLocale)
    {
        $types = type::all();
        $filteredData = [];
        foreach ($types as $typeRow) {
            $type = $typeRow->getTranslation('type', $appLocale);
            $filteredData[] = [
                'id' => $typeRow->id,
                'type' => $type,
            ];
        }
        return response()->json($filteredData);
    }
}
