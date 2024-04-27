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
        $types = type::all();
        return view('MainDashboard.types/types_list' ,compact('types'));
    }

    public function store(TypesRequest $request)
    {
        $data = $request->validated();
        type::create($data);
        return redirect()->back()->with(['message' => 'Successfully added']);
    }

    public function update(TypesRequest $request, type $type)
    {
        $data = $request->validated();
        $type->update($data);
        return redirect()->back()->with(['message' => 'Successfully updated']);
    }

    public function destroy(type $type)
    {
        $type->delete();
        return redirect()->back()->with(['message' => 'Successfully deleted']);
    }
}
