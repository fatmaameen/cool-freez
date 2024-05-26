<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FCMService
{
    protected $messaging;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(storage_path('service-account.json'));
        $this->messaging = $factory->createMessaging();
    }

    public function sendNotification($data)
    {
        $token = $data['device_token'];
        $title = $data['title'];
        $body = $data['body'];
        $message = CloudMessage::withTarget('token', $token)
            ->withNotification(Notification::create($title, $body));

        try {
            $this->messaging->send($message);
            return response()->json(['success' => 'Notification sent successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send notification', 'message' => $e->getMessage()]);
        }
    }
}
