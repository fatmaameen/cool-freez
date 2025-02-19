<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\offers;

use App\Models\offer;
use App\Models\Client;
use App\Traits\ImageUploadTrait;
use App\Jobs\SendNotificationJob;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\MainDashboard\offers\OffersRequest;
use App\Http\Requests\Dashboard\MainDashboard\offers\OffersUpdateRequest;

class AdminOffersController extends Controller
{
    use ImageUploadTrait;
    public function index()
    {
        $offers = offer::all();
        return view('MainDashboard.offers.offer_list', compact('offers'));
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

            // send notification to all clients
            $data_['title'] = config('app.name');
            $data_['body'] = 'New Offer added check it now';
            $deviceTokens = Client::whereNotNull('device_token')->pluck('device_token');
            foreach ($deviceTokens as $deviceToken) {
                $data_['device_token'] = $deviceToken;
                SendNotificationJob::dispatch($data_);
            }

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            // Log::error("Error adding offer: " . $e->getMessage());
            // return redirect()->back()->with(['message' => 'Error adding offer'], 500);
            $notification = array(
                'message' => trans($e->getMessage()),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
         }
    }

    public function update(OffersUpdateRequest $request, Offer $offer)
{
    try {
        $data = $request->validated();
        if ($request->has('offer')) {
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
            }
        } else {
            $offer->update([
                'type' => $data['type'],
                'link' => $data['link'],
            ]);
            $notification = array(
                'message' => trans('main_trans.editing'),
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    } catch (\Exception $e) {
        $notification = array(
            'message' => trans('main_trans.something_error'),
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}

    public function destroy(offer $offer)
    {
        $old_image = $offer->offer;
        if ($this->remove($old_image)) {
            $offer->delete();
            $notification = array(
                'message' => trans('main_trans.successfully_deleted'),
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => trans('main_trans.something_error'),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
