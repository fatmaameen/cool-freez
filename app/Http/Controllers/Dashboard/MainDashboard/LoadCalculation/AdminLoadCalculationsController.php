<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\LoadCalculation;

use Illuminate\Http\Request;
use App\Models\loadCalculation;
use App\Notifications\newNotify;
use App\Jobs\SendNotificationJob;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\MainDashboard\loadCalculation\loadInfoResource;

class AdminLoadCalculationsController extends Controller
{
    public function index()
    {
        $loads = loadCalculation::latest()->get();
        return view('MainDashboard.loadCalculation.loadCalculation_list', compact('loads'));
    }

    public function show($id)
    {
        $load = loadCalculation::where('id', $id)->with(['client', 'model'])->first();
        $data = loadInfoResource::make($load);
        return view('MainDashboard.loadCalculation.details', compact('data'));
        //return response()->json($data);
    }

    public function update(Request $request, loadCalculation $load)
    {
        $request->validate([
            'admin_status' => ['required'],
        ]);

        try {
            $load->update([
                'admin_status' => $request->admin_status,
            ]);

            // Notification here

            $notification = array(
                'message' => trans('main_trans.editing'),
                'alert-type' => 'success'
            );

            /*
                App notification
            */
            //stored notification
            $notifyData['message'] = 'your load calculation order has been' . ' ' . $request->admin_status;
            $load->client->notify(new newNotify($notifyData));
            //fly notification
            $token = $load->client->device_token;
            $data['device_token'] = $token;
            $data['title'] = config('app.name');
            $data['body'] = 'your load calculation order has been' . ' ' . $request->admin_status;
            SendNotificationJob::dispatch($data);

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }
    public function destroy(loadCalculation $load)
    {
        $load->delete();
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
            $loads = loadCalculation::where('code', 'LIKE', '%' . $search . '%')->get();
            if ($loads) {
                return response()->json($loads);
            } else {
                return response()->json(['Message' => "No Data Found"]);
            }
        } elseif ($search === 'null') {
            $loads = loadCalculation::all();
            return response()->json($loads);
        }
    }
}
