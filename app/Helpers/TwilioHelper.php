<?php

namespace App\Helpers;

use Twilio\Rest\Client;

class TwilioHelper
{
    public static function sendOTP($to, $otp)
    {
        $twilio_sid = getenv('TWILIO_SID');
        $twilio_token = getenv('TWILIO_AUTH_TOKEN');
        $twilio_number = getenv('TWILIO_PHONE_NUMBER');

        $client = new Client($twilio_sid, $twilio_token);

        $message = "Your OTP is: $otp";
        try {
            $client->messages
                ->create(
                    $to,
                    [
                        "body" => $message,
                        "from" => $twilio_number
                    ]
                );
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
