<?php

namespace App\Http\Controllers\Clients\Reviews;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clients\Reviews\ReviewRequest;
use App\Helpers\CodeGeneration;
use App\Models\review;
use Illuminate\Support\Facades\Log;
use App\Traits\PDFUploadTrait;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    use PDFUploadTrait;
    public function store(ReviewRequest $request)
    {
        try {
            $data = $request->validated();
            $pdf = $request->file('building_files');
            $pdf_names = $this->uploadPDF($pdf, "reviews_files");
            do {
                $code = CodeGeneration::generateCode();
            } while (review::where('code', $code)->exists());
            $data['code'] = $code;
            $data['building_files'] = json_encode($pdf_names);;

            review::create($data);
            return response()->json(['message' => 'Created successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error adding review' . $e->getMessage()], 500);
        }
    }
}
