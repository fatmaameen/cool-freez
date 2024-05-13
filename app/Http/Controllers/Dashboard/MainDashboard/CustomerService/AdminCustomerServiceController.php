<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\CustomerService;

use App\Mail\mailer;
use Illuminate\Http\Request;
use App\Models\CustomerService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\MainDashboard\CustomerService\ReplyCustomerServiceRequest;
use Illuminate\Support\Facades\Mail;

class AdminCustomerServiceController extends Controller
{
    public function index()
    {
        $messages = CustomerService::all();
        return view('MainDashboard.customer_service.customer_list',compact('messages'));
    }

    public function update(Request $request, CustomerService $message)
    {

        $message->update([
            'status' => $request->status
        ]);
        $notification = array(
            'message' => trans('main_trans.editing'),
          'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);    }

    public function sendEmail(ReplyCustomerServiceRequest $request, CustomerService $message)
    {
try{

    $data = $request->validated();
    if (Mail::to($data['email'])->send(new mailer($data))) {
        $message->update([
            'status' => 'Replied'
        ]);
        $notification = array(
            'message' => trans('main_trans.adding'),
          'alert-type' => 'success'
            );
              return redirect()->back()->with($notification);  }
} catch (\Exception $e) {
            return redirect()->back()->with(['message' => 'Something went wrong']);
        }
    }

    public function destroy(CustomerService $message)
    {
        $message->delete();
        $notification = array(
            'message' => trans('main_trans.deleting'),
          'alert-type' => 'error'
            );
              return redirect()->back()->with($notification);      }
}
