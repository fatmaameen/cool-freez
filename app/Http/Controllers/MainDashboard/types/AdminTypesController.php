<?php

namespace App\Http\Controllers\MainDashboard\types;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainDashboard\types\TypesRequest;
use App\Models\type;
use Illuminate\Http\Request;

class AdminTypesController extends Controller
{
    public function index()
    {
        $types = type::all();
        return response()->json($types);
    }

    public function store(TypesRequest $request)
    {
        $data = $request->validated();
        type::create($data);
        return response()->json(['message' => 'Successfully added']);
    }

    public function update(TypesRequest $request, type $type)
    {
        $data = $request->validated();
        $type->update($data);
        return response()->json(['message' => 'Successfully updated']);
    }

    public function destroy(type $type)
    {
        $type->delete();
        return response()->json(['message' => 'Successfully deleted']);
    }
}
