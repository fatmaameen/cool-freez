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
        return redirect()->back()->with(['message' => 'Successfully updated']);
    }

    public function sendEmail(ReplyCustomerServiceRequest $request, CustomerService $message)
    {
try{

    $data = $request->validated();
    if (Mail::to($data['email'])->send(new mailer($data))) {
        $message->update([
            'status' => 'Replied'
        ]);
        return redirect()->back()->with(['message' => 'Sent successfully']);
}
} catch (\Exception $e) {
            return redirect()->back()->with(['message' => 'Something went wrong']);
        }
    }

    public function destroy(CustomerService $message)
    {
        $message->delete();
        return redirect()->back()->with(['message' => 'Successfully deleted']);
    }
}
