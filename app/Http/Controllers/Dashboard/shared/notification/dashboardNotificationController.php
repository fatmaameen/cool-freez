<?php

namespace App\Http\Controllers\Dashboard\shared\notification;

use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;


class dashboardNotificationController extends Controller
{
    public function read($id){
        $notifications = DatabaseNotification::where('notifiable_id', $id)->get();
        foreach ($notifications as $notification) {
            $notification->markAsRead();
        }
        return redirect()->back();
    }
}
