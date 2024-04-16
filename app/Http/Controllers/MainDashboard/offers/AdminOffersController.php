<?php

namespace App\Http\Controllers\MainDashboard\offers;

use App\Models\offer;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\MainDashboard\offers\OffersRequest;

class AdminOffersController extends Controller
{
    use ImageUploadTrait;
    public function index()
    {
        $offers = offer::all();
        return view('offers.offer_list' ,compact('offers'));
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
            ]);

            return response()->json(['message' => 'Successfully added']);
        } catch (\Exception $e) {
            Log::error("Error adding offer: " . $e->getMessage());
            return redirect()->back()->with(['message' => 'Error adding offer'], 500); // Internal Server Error
        }
    }

    public function update(OffersRequest $request, offer $offer)
    {
        $data = $request->validated();
        $old_image = $offer->offer;
        if ($this->remove($old_image, 'offers')) {
            $image = $request->file('offer');
            $new_offer = $this->upload($image, 'offers');
            $offer->update([
                'offer' => $new_offer,
                'link' => $data['link'],
            ]);
            return  redirect()->back()->with(['message' => 'Successfully updated']);
        } else {
            return  redirect()->back()->with(['message' => 'Something went wrong']);
        }
    }

    public function destroy(offer $offer)
    {
        $old_image = $offer->offer;
        if ($this->remove($old_image, 'offers')) {
            $offer->delete();
            return  redirect()->back()->with(['message' => 'Successfully deleted']);
        } else {
            return  redirect()->back()->with(['message' => 'Something went wrong']);
        }
    }
}
