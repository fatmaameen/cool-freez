<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\pricing;

use App\Http\Controllers\Controller;
use App\Models\pricing;
use App\Models\pricingDetail;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;

class AdminPricingController extends Controller
{
    use ImageUploadTrait;
    public function index()
    {
        $pricing = pricing::latest()->get();
        return view('MainDashboard.pricing.pricing_list' ,compact('pricing'));
    }

    public function show($id)
    {
        $pricing = pricing::where('id', $id)->with(['client', 'details'])->first();
        return view('MainDashboard.pricing.details',compact('pricing'));
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
              return redirect()->back()->with($notification);       }
}
