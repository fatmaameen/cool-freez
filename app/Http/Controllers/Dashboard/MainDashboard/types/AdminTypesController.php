<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\types;

use App\Models\type;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\MainDashboard\types\TypesRequest;

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
        $notification = array(
            'message' => trans('main_trans.adding'),
            'alert-type' => 'success'
             );
        return redirect()->back()->with($notification);
    }

    public function update(TypesRequest $request, type $type)
    {
        $data = $request->validated();
        $type
            ->setTranslation('type', 'en', strtolower($data['type_en']))
            ->setTranslation('type', 'ar', $data['type_ar']);
        $type->save();
        $notification = array(
            'message' => trans('main_trans.editing'),
            'alert-type' => 'success'
             );
        return redirect()->back()->with($notification);
    }

    public function destroy(type $type)
    {
        $type->delete();
        $notification = array(
            'message' => trans('main_trans.deleting'),
          'alert-type' => 'success'
            );
              return redirect()->back()->with($notification);
    }
}
