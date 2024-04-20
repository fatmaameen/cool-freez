<?php

namespace App\Http\Controllers\MainDashboard\usings;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainDashboard\usings\usingRequest;
use App\Models\using;
use Illuminate\Http\Request;

class AdminUsingsController extends Controller
{
    public function index()
    {
        $usings = using::all();
        return response()->json($usings);
    }

    public function store(usingRequest $request)
    {
        $data = $request->validated();
        using::create($data);
        return redirect()->back()->with(['message' => 'Successfully added']);
    }

    public function update(usingRequest $request, using $using)
    {
        $data = $request->validated();
        $using->update($data);
        return redirect()->back()->with(['message' => 'Successfully updated']);
    }

    public function destroy(using $using)
    {
        $using->delete();
        return redirect()->back()->with(['message' => 'Successfully deleted']);
    }
}
