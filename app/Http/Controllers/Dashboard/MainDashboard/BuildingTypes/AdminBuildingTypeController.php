<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\BuildingTypes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\MainDashboard\BuildingTypes\BuildingTypeRequest;
use App\Models\BuildingType;
use Illuminate\Http\Request;

class AdminBuildingTypeController extends Controller
{
    public function index()
    {
        $appLocale = app()->getLocale();
        $BuildingTypes = BuildingType::all();
        $filteredData = [];
        foreach ($BuildingTypes as $type) {
            $rowData = $type->getTranslation('name', $appLocale);
            $name_en = $type->getTranslation('name', 'en');
            $name_ar = $type->getTranslation('name', 'ar');
            $filteredData[] = [
                'id' => $type->id,
                'name' => $rowData,
                'name_en' => $name_en,
                'name_ar' => $name_ar,
            ];
        }
        return view('MainDashboard.BuildingTypes.BuildingTypes_list' ,compact('filteredData'));
    }

    public function store(BuildingTypeRequest $request)
    {
        $data = $request->validated();
        $type = new BuildingType();
        $type
            ->setTranslation('name', 'en', strtolower($data['name_en']))
            ->setTranslation('name', 'ar', $data['name_ar']);
        $type->save();
        $notification = array(
            'message' => trans('main_trans.adding'),
            'alert-type' => 'success'
             );


        return redirect()->back()->with($notification);        }

    public function update(BuildingTypeRequest $request, BuildingType $BuildingType)
    {
        $data = $request->validated();
        $BuildingType
            ->setTranslation('name', 'en', strtolower($data['name_en']))
            ->setTranslation('name', 'ar', $data['name_ar']);
            $BuildingType->save();
            $notification = array(
                'message' => trans('main_trans.editing'),
                'alert-type' => 'success'
                 );


            return redirect()->back()->with($notification);    }

    public function destroy(BuildingType $BuildingType)
    {
        $BuildingType->delete();
        $notification = array(
            'message' => trans('main_trans.deleting'),
          'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);    
        }
}
