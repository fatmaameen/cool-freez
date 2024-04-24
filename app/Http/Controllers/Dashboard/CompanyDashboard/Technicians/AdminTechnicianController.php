<?php

namespace App\Http\Controllers\Dashboard\CompanyDashboard\Technicians;

use App\Models\technician;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class AdminTechnicianController extends Controller
{
    use ImageUploadTrait;
    protected $appUrl;
    public function __construct()
    {
        $this->appUrl = Config::get('app.url');
    }

    public function index()
    {
        $technicians = technician::latest();
        return response()->json($technicians);
    }

    public function store(Request $request){
        
    }

}
