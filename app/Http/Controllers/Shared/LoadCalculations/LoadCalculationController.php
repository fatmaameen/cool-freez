<?php

namespace App\Http\Controllers\Shared\LoadCalculations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shared\LoadCalculations\LoadCalculationRequest;
use App\Models\brand;
use App\Models\cfmRate;
use App\Models\DataSheet;
use App\Models\type;
use App\Models\UsingFloor;

class LoadCalculationController extends Controller
{
    public function loadCalculation(LoadCalculationRequest $request)
    {
        try {
            $data = $request->validated();
            $btu = self::getBTU($data['floor'], $data['using'], $data['appLocal'], $data['length'], $data['width']);
            $type = self::getType($data['type_id']);
            $brand = self::getBrand($data['brand_id']);
            $models = self::getModels($btu, $brand, $type);
            if ($models) {
                $final_data = self::getData($models, $data['length'], $data['width']);
                return response()->json($final_data);
            } else {
                return response()->json(['message' => 'no available models']);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'something went wrong', 'errors' => $e->getMessage()]);
        }
    }

    private static function getBTU($floor, $using, $appLocal, $length, $width)
    {
        $floorData = 'floor->' . $appLocal;
        $usingData = 'using->' . $appLocal;
        $rowData = UsingFloor::where($floorData, $floor)
            ->where($usingData, $using)
            ->first();
        if (!$rowData) {
            return null;
        }
        return $rowData->value * $length * $width;
    }

    private static function getModels($btu, $brand, $type)
    {
        $models = DataSheet::where('btu', '>', $btu)
            ->where('brand', $brand)
            ->where('type', $type)
            ->get();
        if (count($models) > 0) {
            return $models;
        } else {
            return false;
        }
    }

    private static function getData($models, $length, $width)
    {
        $area = $length * $width;
        $data = [];
        foreach ($models as $model) {
            $cfmPerSqM = $model->cfm / $area;
            $data[] = [
                'model_id' => $model->id,
                'model' => $model->model,
                'btu' => $model->btu,
                'cfm' => $model->cfm,
                'cfmPerSqM' => $cfmPerSqM,
                'made_in' => $model->made_in,
                'rate' => self::getRate($cfmPerSqM),
            ];
        }
        return $data;
    }

    private static function getRate(float $cfmPerSqM)
    {
        $rate_data = cfmRate::all()->first();
        if ($cfmPerSqM >= $rate_data->poor_from && $cfmPerSqM <= $rate_data->poor_to) {
            return 'POOR';
        } elseif ($cfmPerSqM >= $rate_data->good_from && $cfmPerSqM <= $rate_data->good_to) {
            return 'GOOD';
        } elseif ($cfmPerSqM >= $rate_data->excellent_from && $cfmPerSqM <= $rate_data->excellent_to) {
            return 'EXCELLENT';
        } elseif ($cfmPerSqM > $rate_data->excellent_to) {
            return 'EXCELLENT';
        }
    }

    private static function getType($id)
    {
        $type = type::where('id', $id)->first();
        $type = $type->getTranslation('type', 'en');
        return $type;
    }

    private static function getBrand($id)
    {
        $brand = brand::where('id', $id)->first();
        $brand = $brand->getTranslation('brand', 'en');
        return $brand;
    }
}
