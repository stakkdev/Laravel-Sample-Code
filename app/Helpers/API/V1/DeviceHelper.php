<?php

namespace App\Helpers\API\V1;

use App\Models\DeviceDetail;
use Illuminate\Support\Facades\Request;

class DeviceHelper
{
	// save the device details
	public static function saveDeviceDetail($user)
	{
		$device_id =  Request::header('device-id') ?  Request::header('device-id') : "";
		// delete all the previous records in device details table
		$Device_details = DeviceDetail::where(['user_id' => $user->id, 'device_id' => $device_id])->delete();

		// save device details
		DeviceDetail::create([
			'device_id' => $device_id,
			'user_id' => $user->id,
			'device_token' => Request::header('FCM-token') ?? "",
			'build_version' => Request::header('build-version') ?? "",
			'platform' => Request::header('platform') ?? "",
			'build' => Request::header('build') ?? "",
			'build_mode' => Request::header('build-mode') ?? "",

		]);

		return true;
	}

	// delete te device details
	public static function deleteDevice($user)
	{
		$device_id =  Request::header('device-id') ?  Request::header('device-id') : "";
		// delete all the previous records in device details table
		return DeviceDetail::where(['user_id' => $user->id, 'device_id' => $device_id])->delete();
	}
}
