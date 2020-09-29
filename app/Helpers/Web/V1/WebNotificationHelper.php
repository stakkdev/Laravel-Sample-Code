<?php

namespace App\Helpers\Web\V1;

use Exception;
use App\Models\DeviceDetail;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Brackets\AdminAuth\Models\AdminUser;

class WebNotificationHelper 
{    
    public static function sendNotificationAllVandors($title, $body)
    {
        $vandors = AdminUser::get();

        $fcm_notification_data = [];
        foreach ($vandors as $key => $vandor) {
            $deviceDetail = DeviceDetail::where(["user_id" => $vandor->id,"platform" => "Web"])->first();
            
            if($deviceDetail){
                $fcm_notification_data[] = [
                    'token' => $deviceDetail->device_token,
                    "notification" => [
                        'title' => $title,
                        'body' => $body,
                        'priority' => '"high"',
                        "icon" => storage_path('logo/logo.png'),
                        "image" => storage_path('logo/logo.png'),
                     ]
                ];
            } 
        }

        //dd($fcm_notification_data);

        self::sendNotification($fcm_notification_data);
    }

    private static function sendNotification($fcm_notification_data)
    {
        $factory = (new Factory())->withServiceAccount(storage_path('app/firebase-admin.json'));
        $messaging = $factory->createMessaging();

        return $messaging->sendAll($fcm_notification_data);
    }
}
