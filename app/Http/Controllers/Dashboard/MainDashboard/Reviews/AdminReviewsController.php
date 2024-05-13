<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\Reviews;

use App\Models\review;
use Illuminate\Http\Request;
use App\Traits\PDFUploadTrait;
use App\Http\Controllers\Controller;

class AdminReviewsController extends Controller
{
    use PDFUploadTrait;
    public function index()
    {
        $reviews = review::with('client', 'consultant')->get();
        return view('MainDashboard.reviews/reviews_list', compact('reviews'));
    }

    public function show_details($id)
    {
        $review = review::where('id', $id)->with('client', 'consultant')->first();

      return view('MainDashboard.reviews.details', compact('review'));
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

            $notification = array(
                'message' => trans('main_trans.editing'),
                'alert-type' => 'success'
                 );


            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            return  redirect()->back()->with(['message' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(review $review)
    {
        $old_files = $review->building_files;
        if ($this->removePDF($old_files, 'reviews_files')) {
            $review->delete();

            $notification = array(
                'message' => trans('main_trans.deleting'),
              'alert-type' => 'error'
                );
                  return redirect()->back()->with($notification);
        } else {
            return redirect()->back()->with(['message' => 'Something went wrong']);
        }
    }
}
