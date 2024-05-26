<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\Notification;

use App\Models\Client;
// use App\Services\FCMService;
use Illuminate\Http\Request;
use App\Jobs\SendNotificationJob;
use App\Http\Controllers\Controller;

class AdminNotificationController extends Controller
{
    // protected $fcmService;

    // public function __construct(FCMService $fcmService)
    // {
    //     $this->fcmService = $fcmService;
    // }
    public function create()
    {
        return view('MainDashboard.notification.notification');
    }
    public function sendNotification(request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        $deviceTokens = Client::whereNotNull('device_token')->pluck('device_token');
        foreach ($deviceTokens as $deviceToken) {
            $data['device_token'] = $deviceToken;
            SendNotificationJob::dispatch($data);
        }
    }
}
