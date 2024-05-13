<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\clients;

use App\Models\Role;
use App\Models\Client;
use App\Models\review;
use App\Models\pricing;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Models\loadCalculation;
use App\Traits\ImageUploadTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Http\Resources\Api\Clients\ordersHistory\loadHistoryResource;
use App\Http\Resources\Api\Clients\ordersHistory\reviewHistoryResource;
use App\Http\Resources\Api\Clients\ordersHistory\pricingHistoryResource;
use App\Http\Resources\Api\Clients\ordersHistory\maintenanceHistoryResource;

class AdminClientsController extends Controller
{
    use ImageUploadTrait;
    protected $appUrl;
    public function __construct()
    {
        $this->appUrl = Config::get('app.url');
    }
    public function index()
    {
        $clients = Client::all();
        return view('MainDashboard.clients.client_list', compact('clients'));
    }

    public function banned(Request $request, Client $client)
    {
        $request->validate([
            'is_banned' => ['required'],
        ]);

        try {
            $client->update([
                'is_banned' => $request->is_banned,
            ]);

            // Notification here

            return response()->json(['message' => 'Updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong' . $e->getMessage()], 500);
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'is_banned' => ['required', 'boolean'],
        ]);
        Client::find($id)->update([
            'is_banned' => $request->is_banned,
        ]);

        $notification = array(
            'message' => trans('main_trans.editing'),
            'alert-type' => 'success'
             );


        return redirect()->back()->with($notification);
    }

    public function destroy(Client $client)
    {
        $old_image = $client->image;
        if ($old_image == $this->appUrl . '/' . 'defaults_images' . '/' . 'image.png') {
            $client->delete();

            $notification = array(
                'message' => trans('main_trans.deleting'),
              'alert-type' => 'error'
                );
                  return redirect()->back()->with($notification);
        } else {
            if ($this->remove($old_image)) {
                $client->delete();
                return  redirect()->back()->with(['message' => 'Successfully deleted']);
            } else {
                return  redirect()->back()->with(['message' => 'Something went wrong']);
            }
        }
    }

    public function history($id)
    {
        $maintenances = Maintenance::where('client_id', $id)->with('service')->get();
        $pricing = pricing::where('client_id', $id)->with('service')->get();
        $reviews = review::where('client_id', $id)->get();
        $loads = loadCalculation::where('client_id', $id)->with('service')->get();

        $maintenances = maintenanceHistoryResource::collection($maintenances);
        $pricing = pricingHistoryResource::collection($pricing);
        $reviews = reviewHistoryResource::collection($reviews);
        $loads = loadHistoryResource::collection($loads);

        $mergedData = [];
        foreach ($maintenances as $maintenance) {
            $mergedData[] =  $maintenance;
        }
        foreach ($pricing as $pricing) {
            $mergedData[] = $pricing;
        }
        foreach ($reviews as $review) {
            $mergedData[] = $review;
        }
        foreach ($loads as $load) {
            $mergedData[] = $load;
        }

        usort($mergedData, function ($a, $b) {
            return strcmp($b->created_at, $a->created_at);
        });

        return response()->json($mergedData);
    }

    public function search($search)
    {
        if ($search!='null') {
            $clients = Client::where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')->get();
            if ($clients) {
                return response()->json($clients);
            } else {
                return response()->json(['Message' => "No Data Found"]);
            }
        } elseif($search === 'null') {
            $clients = Client::all();
            return response()->json($clients);
        }
    }
}
