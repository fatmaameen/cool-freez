<?php

namespace App\Http\Controllers\MainDashboard\Reviews;

use App\Http\Controllers\Controller;
use App\Models\review;
use Illuminate\Http\Request;
use App\Traits\PDFUploadTrait;

class AdminReviewsController extends Controller
{
    use PDFUploadTrait;
    public function index(){
        $reviews = review::with('client', 'consultant')->get();
        return response()->json($reviews);
    }

    public function update(Request $request, review $review)
    {
        $request->validate([
            'admin_status' => ['required'],
        ]);

        try {
            $review->update([
                'admin_status' => $request->admin_status,
            ]);

            // Notification here

            return redirect()->back()->with(['message' => 'Updated successfully']);
        } catch (\Exception $e) {
            return  redirect()->back()->with(['message' => 'Update failed: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(review $review)
    {
        $old_files = $review->building_files;
        if ($this->removePDF($old_files, 'reviews_files')) {
            $review->delete();
            return response()->json(['message' => 'Successfully deleted']);
        } else {
            return response()->json(['message' => 'Something went wrong']);
        }
    }
}
