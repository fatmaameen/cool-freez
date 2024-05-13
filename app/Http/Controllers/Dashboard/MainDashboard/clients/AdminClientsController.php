<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\clients;

use App\Models\Role;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Http\Resources\Api\Clients\ordersHistory\loadHistoryResource;
use App\Http\Resources\Api\Clients\ordersHistory\maintenanceHistoryResource;
use App\Http\Resources\Api\Clients\ordersHistory\pricingHistoryResource;
use App\Http\Resources\Api\Clients\ordersHistory\reviewHistoryResource;
use App\Models\loadCalculation;
use App\Models\Maintenance;
use App\Models\pricing;
use App\Models\review;


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

    public function history($id)

    {


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

    public function search(Request $request)
    {
        $request->validate([
            'search' => ['required', 'string'],
        ]);
        $search = $request->search;
        $clients = Client::where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')->get();
        if ($clients) {
            return redirect()->back()->with($clients);
        } else {
            return redirect()->back()->with(['Message' => "No Data Found"]);
        }
    }
}
