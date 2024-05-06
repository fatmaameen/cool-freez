<?php

namespace App\Helpers;

use App\Models\User;
use App\Notifications\newNotify;

class sendNotification
{
    public static function maintenanceNotify($data){
        $notifyData['message'] = sprintf('%s add new %s order',
        $data->client->name,$data->service->service_name);
        $notifyData['url'] = route('maintenance');
        $notifyData['image'] = $data->client->image;
        $admins = self::getMainAdmins();
        self::notify($admins,$notifyData);
    }

    public static function pricingNotify($data){
        $notifyData['message'] = sprintf('%s add new pricing order',
        $data->client->name);
        $notifyData['url'] = route('pricing.pricing');
        $notifyData['image'] = $data->client->image;
        $admins = self::getMainAdmins();
        self::notify($admins,$notifyData);
    }

    public static function reviewNotify($data){
        $notifyData['message'] = sprintf('%s add new review order',
        $data->client->name);
        $notifyData['url'] = route('reviews.reviews');
        $notifyData['image'] = $data->client->image;
        $admins = self::getMainAdmins();
        self::notify($admins,$notifyData);
    }

    public static function loadNotify($data){
        $notifyData['message'] = sprintf('%s add new load order',
        $data->client->name);
        $notifyData['url'] = route('loadCalculation');
        $notifyData['image'] = $data->client->image;
        $admins = self::getMainAdmins();
        self::notify($admins,$notifyData);
    }

    public static function assignNotify(){
        $notifyData['message'] = 'new maintenance assigned';
        $notifyData['url'] = route('loadCalculation');
        $admins = self::getCompanyAdmins();
        self::notify($admins,$notifyData);
    }
    private static function getMainAdmins()
    {
        $admins = User::where('role_id', '=',1)
        ->orwhere('role_id', '=',2)->get();
        return $admins;
    }

    private static function getCompanyAdmins()
    {
        $admins = User::where('role_id', '=',3)->get();
        return $admins;
    }

    private static function notify($admins,$notifyData){
        foreach ($admins as $admin) {
            $admin->notify(new newNotify($notifyData));
        }
    }
}
