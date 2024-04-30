<?php

namespace App\Http\Controllers\Api\Clients\usings;

use App\Http\Controllers\Controller;
use App\Models\UsingFloor;


class usingsController extends Controller
{
    public function index($appLocale)
    {
        $usings = UsingFloor::all();
        $filteredData = [];
        $uniqueUsings = [];
        foreach ($usings as $usingRow) {
            $using = $usingRow->getTranslation('using', $appLocale);
            if (!in_array($using, $uniqueUsings)) {
                $filteredData[] = [
                    'id' => $usingRow->id,
                    'using' => $using,
                ];
                $uniqueUsings[] = $using;
            }
        }
        return response()->json($filteredData);
    }
}
