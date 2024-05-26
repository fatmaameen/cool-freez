<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\pricing;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Clients\ordersHistory\pricingHistoryResource;
use App\Models\pricing;
use App\Models\pricingDetail;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use App\Jobs\SendNotificationJob;
use App\Notifications\newNotify;

class AdminPricingController extends Controller
{
    use ImageUploadTrait;
    public function index()
    {
        $pricing = pricing::latest()->get();
        return view('MainDashboard.pricing.pricing_list', compact('pricing'));
    }
    public function getPricingDetails($id)
    {
        $pricing = Pricing::with('details')->findOrFail($id);
        return view('pricing_details', ['pricing' => $pricing]);
    }

    public function show($id)
    {
        $pricing = pricing::where('id', $id)->with(['client', 'details'])->first();
        return view('MainDashboard.pricing.details', compact('pricing'));
    }

    public function update(Request $request, pricing $pricing)
    {
        $request->validate([
            'admin_status' => ['required'],
        ]);

        try {
            $pricing->update([
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
            $notifyData['message'] = 'your pricing order has been' . ' ' . $request->admin_status;
            $pricing->client->notify(new newNotify($notifyData));
            //fly notification
            $token = $pricing->client->device_token;
            $data['device_token'] = $token;
            $data['title'] = config('app.name');
            $data['body'] = 'your pricing order has been' . ' ' . $request->admin_status;
            SendNotificationJob::dispatch($data);
            return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            return  redirect()->back()->with(['error' => 'Update failed: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(pricing $pricing)
    {
        $details = pricingDetail::where('pricing_id', $pricing->id)->get();
        foreach ($details as $item) {
            if ($this->remove($item['drawing_of_building'])) {
                $item->delete();
            } else {
                return redirect()->back()->with(['message' => 'Failed to delete file']);
            }
        }
        $pricing->delete();

        $notification = array(
            'message' => trans('main_trans.deleting'),
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
    public function search($search)
    {
        if ($search != 'null') {
            $search = strtoupper($search);
            $loads = pricing::where('code', 'LIKE', '%' . $search . '%')->get();
            if ($loads) {
                return response()->json($loads);
            } else {
                return response()->json(['Message' => "No Data Found"]);
            }
        } elseif ($search === 'null') {
            $loads = pricing::all();
            return response()->json($loads);
        }
    }
}
