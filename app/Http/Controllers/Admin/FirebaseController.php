<?php

namespace App\Http\Controllers\Admin;

use App\Models\DeviceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Brackets\AdminAuth\Models\AdminUser;
use App\Helpers\Web\V1\WebNotificationHelper;

class FirebaseController extends Controller
{
    public function saveToken(Request $request)
    {
		$deviceDetail = DeviceDetail::where(['platform' => 'Web','user_id'=> Auth::user()->id])->first();
		
		if($deviceDetail){
			$deviceDetail->update(['device_token' => $request->device_token]);
		} else {
			$deviceDetail = DeviceDetail::create([
				'user_id' => Auth::user()->id,
				'device_token' => $request->device_token,
				'platform' => "Web",
			]);
		}

		return true;
	}
	
	public function save()
    {
		$title = "web notification title";
		$body = "web notification body";
		
		WebNotificationHelper::sendNotificationAllVandors($title,$body);
    }
}
