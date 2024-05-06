<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\types;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\MainDashboard\types\TypesRequest;
use App\Models\type;
use Illuminate\Http\Request;

class AdminTypesController extends Controller
{
    public function index()
    {
        $appLocale = app()->getLocale();
        $types = type::all();
        $filteredData = [];
        foreach ($types as $type) {
            $rowData = $type->getTranslation('type', $appLocale);
            $type_en = $type->getTranslation('type', 'en');
            $type_ar = $type->getTranslation('type', 'ar');
            $filteredData[] = [
                'id' => $type->id,
                'type' => $rowData,
                'type_en' => $type_en,
                'type_ar' => $type_ar,
            ];
        }
        return view('MainDashboard.types/types_list', compact('filteredData'));
    }

    public function store(TypesRequest $request)
    {
        $data = $request->validated();
        $type = new type();
        $type
            ->setTranslation('type', 'en', strtolower($data['type_en']))
            ->setTranslation('type', 'ar', $data['type_ar']);
        $type->save();
        return redirect()->back()->with(['message' => __('main_trans.successfully_added')]);
    }

    public function update(TypesRequest $request, type $type)
    {
        $data = $request->validated();
        $type
            ->setTranslation('type', 'en', strtolower($data['type_en']))
            ->setTranslation('type', 'ar', $data['type_ar']);
        $type->save();
        return redirect()->back()->with(['message' => __('main_trans.successfully_updated')]);
    }

    public function destroy(type $type)
    {
        $type->delete();
        return redirect()->back()->with(['message' => __('main_trans.successfully_deleted')]);
    }
}
