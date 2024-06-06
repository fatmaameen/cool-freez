<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\Reviews;

use App\Models\review;
use Illuminate\Http\Request;
use App\Traits\PDFUploadTrait;
use App\Notifications\newNotify;
use App\Jobs\SendNotificationJob;
use App\Http\Controllers\Controller;

class AdminReviewsController extends Controller
{
    use PDFUploadTrait;
    public function index()
    {
        $reviews = review::with('client', 'consultant')->get();
        return view('MainDashboard.reviews/reviews_list', compact('reviews'));
    }
    public function news()
    {
        $reviews = review::where('admin_status', 'waiting')->get();
        return view('MainDashboard.reviews.new_list', compact('reviews'));
    }
    public function comfirmed()
    {
        $reviews = review::where('admin_status', 'confirmed')->get();
        return view('MainDashboard.reviews.comfirmed_list', compact('reviews'));
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

            $notification = array(
                'message' => trans('main_trans.editing'),
                'alert-type' => 'success'
            );

            /*
                App notification
            */
            //stored notification
            $notifyData['message'] = 'your review order has been' . ' ' . $request->admin_status;
            $review->client->notify(new newNotify($notifyData));
            //fly notification
            $token = $review->client->device_token;
            $data['device_token'] = $token;
            $data['title'] = config('app.name');
            $data['body'] = 'your review order has been' . ' ' . $request->admin_status;
            SendNotificationJob::dispatch($data);

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

    public function search($search)
    {
        if ($search != 'null') {
            $search = strtoupper($search);
            $reviews = review::where('code', 'LIKE', '%' . $search . '%')->get();
            if ($reviews) {
                return response()->json($reviews);
            } else {
                return response()->json(['Message' => "No Data Found"]);
            }
        } elseif ($search === 'null') {
            $reviews = review::all();
            return response()->json($reviews);
        }
    }
}
