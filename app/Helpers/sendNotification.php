<?php

namespace App\Helpers;

use App\Models\User;
use App\Notifications\newNotify;

class sendNotification
{
    public static function serviceNotify($data)
    {
        $notifyData['message'] = sprintf(
            '%s Add New %s Order',
            $data->client->name,
            $data->service->service_name
        );
        switch ($data->service->service_name) {
            case 'Maintenance':
                $notifyData['url'] = route('maintenance');
                break;
            case 'Pricing':
                $notifyData['url'] = route('pricing.pricing');
                break;
            case 'Review':
                $notifyData['url'] = route('reviews.reviews');
                break;
            case 'Load calculation':
                $notifyData['url'] = route('loadCalculation');
                break;
        }
        $notifyData['image'] = $data->client->image;
        $admins = self::getMainAdmins();
        self::notify($admins, $notifyData);
    }

    public static function newRegisterNotify()
    {
        $notifyData['message'] = 'New client registered';
        $notifyData['url'] = route('clients');
        $admins = self::getMainAdmins();
        self::notify($admins, $notifyData);
    }

    public static function CompanyUpdateMaintenance()
    {
        $notifyData['message'] = 'Company Updated a Maintenance check it!';
        $notifyData['url'] = route('new_maintenance');
        $admins = self::getMainAdmins();
        self::notify($admins, $notifyData);
    }

    public static function assignNotify($company_id)
    {
        $notifyData['message'] = 'New maintenance assigned';
        $notifyData['url'] = route('incomplete_maintenance', $company_id);
        $admins = self::getCompanyAdmins($company_id);
        self::notify($admins, $notifyData);
    }

    public static function technicalUpdateMaintenanceNotify($company_id)
    {
        $notifyData['message'] = 'Technical Update a Maintenance check it!';
        $notifyData['url'] = route('incomplete_maintenance', $company_id);
        $admins = self::getCompanyAdmins($company_id);
        self::notify($admins, $notifyData);
    }

    public static function customerServiceNotify()
    {
        $notifyData['message'] = 'New customer service message';
        $notifyData['url'] = route('customer_service.customer_service');
        $admins = self::getMainAdmins();
        self::notify($admins, $notifyData);
    }

    private static function getMainAdmins()
    {
        $admins = User::where('role_id', '=', 1)
            ->orwhere('role_id', '=', 2)->get();
        return $admins;
    }

    private static function getCompanyAdmins($company_id)
    {
        $admins = User::where('role_id', '=', 3)
            ->where('company_id', '=', $company_id)
            ->get();
        return $admins;
    }

    private static function notify($admins, $notifyData)
    {
        foreach ($admins as $admin) {
            $admin->notify(new newNotify($notifyData));
        }
    }
}
