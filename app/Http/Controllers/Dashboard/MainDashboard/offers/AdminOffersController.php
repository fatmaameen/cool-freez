<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\offers;

use App\Models\offer;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\MainDashboard\offers\OffersRequest;

class AdminOffersController extends Controller
{
    use ImageUploadTrait;
    public function index()
    {
        $offers = offer::all();
        return view('MainDashboard.offers.offer_list' ,compact('offers'));
    }

    public function store(OffersRequest $request)
    {
         try {
            $data = $request->validated();

            $image = $request->file('offer');
            $offer = $this->upload($image, "offers");

            Offer::create([
                'offer' => $offer,
                'link' => $data['link'],
                'type' => $data['type'],
            ]);

            $notification = array(
                'message' => trans('main_trans.adding'),
                'alert-type' => 'success'
                 );


            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            Log::error("Error adding offer: " . $e->getMessage());
            return redirect()->back()->with(['message' => 'Error adding offer'], 500);
         }
    }

    public function update(OffersRequest $request, offer $offer)
    {
        $data = $request->validated();
        $old_image = $offer->offer;
        if ($this->remove($old_image)) {
            $image = $request->file('offer');
            $new_offer = $this->upload($image, 'offers');
            $offer->update([
                'offer' => $new_offer,
                'type' => $data['type'],
                'link' => $data['link'],
            ]);
            $notification = array(
                'message' => trans('main_trans.editing'),
                'alert-type' => 'success'
                 );


            return redirect()->back()->with($notification);
        } else {
            return  redirect()->back()->with(['message' => 'Something went wrong']);
        }
    }

    public function destroy(offer $offer)
    {
        $old_image = $offer->offer;
        if ($this->remove($old_image)) {
            $offer->delete();
            $notification = array(
                'message' => trans('main_trans.deleting'),
              'alert-type' => 'error'
                );
                  return redirect()->back()->with($notification);        } else {
            return  redirect()->back()->with(['message' => 'Something went wrong']);
        }
    }
}
