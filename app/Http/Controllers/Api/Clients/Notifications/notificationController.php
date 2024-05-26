<?php

namespace App\Http\Controllers\Api\Clients\Notifications;

use App\Http\Controllers\Controller;
use App\Models\Client;

class notificationController extends Controller
{
    public function getUnread(Client $client)
    {
        if (!$client) {
            return response()->json(['error' => 'Client not found']);
        }

        // $unreadNotifications = $client->unreadNotifications;
        $unreadNotifications = $client->unreadNotifications->map(function ($notification) {
            return [
                'message' => $notification->data['message'],
                'created_at' => $notification->created_at,
            ];
        });
        return response()->json($unreadNotifications);
    }

    public function markAsRead(Client $client)
    {
        if (!$client) {
            return response()->json(['error' => 'Client not found']);
        }

        $client->unreadNotifications->markAsRead();

        return response()->json(['message' => 'All notifications marked as read']);
    }
}
