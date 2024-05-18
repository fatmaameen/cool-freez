<?php

namespace App\Http\Controllers\Api\Clients\Reviews;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Clients\Reviews\ReviewRequest;
use App\Helpers\CodeGeneration;
use App\Helpers\sendNotification;
use App\Models\review;
use App\Traits\PDFUploadTrait;

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
            $data['building_files'] = json_encode($pdf_names);
            $newRow = review::create($data);
            sendNotification::serviceNotify($newRow);
            return response()->json(['message' => 'Created successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'something went wrong' . $e->getMessage()], 500);
        }
    }
}
