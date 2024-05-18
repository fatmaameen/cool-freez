<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\Companies;

use App\Http\Controllers\Controller;
use App\Models\company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function index()
    {
        $companies = company::all();
        $appLocale = app()->getLocale();
        $filteredData = [];
        foreach ($companies as $company) {
            $name = $company->getTranslation('name', $appLocale);
            $name_en = $company->getTranslation('name', 'en');
            $name_ar = $company->getTranslation('name', 'ar');
            $filteredData[] = [
                'id' => $company->id,
                'name' => $name,
                'name_en' => $name_en,
                'name_ar' => $name_ar,
                'phone' => $company->phone,
                'address' => $company->address,
            ];
        }
        // return response()->json($filteredData);
        return view('MainDashboard.Companies.companies_list', compact('filteredData'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'phone' => 'required|unique:companies',
            'address' => 'required',
        ]);
        $company = new company();
        $company
            ->setTranslation('name', 'en', strtolower($data['name_en']))
            ->setTranslation('name', 'ar', $data['name_ar']);
        $company->phone = $data['phone'];
        $company->address = $data['address'];
        $company->save();
        $notification = array(
            'message' => trans('main_trans.successfully_added'),
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function update(Request $request, company $company)
    {
        $data = $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'phone' => 'required|unique:companies,phone,' . $company->id,
            'address' => 'required',
        ]);
        $company
            ->setTranslation('name', 'en', strtolower($data['name_en']))
            ->setTranslation('name', 'ar', $data['name_ar']);
        $company->phone = $data['phone'];
        $company->address = $data['address'];
        $company->save();
        $notification = array(
            'message' => trans('main_trans.successfully_updated'),
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function destroy(company $company)
    {
        $company->delete();
        $notification = array(
            'message' => trans('main_trans.successfully_deleted'),
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
