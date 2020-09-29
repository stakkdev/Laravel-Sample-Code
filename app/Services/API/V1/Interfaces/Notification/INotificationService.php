<?php

namespace App\Services\API\V1\Interfaces\Notification;

// load Custom Requests
use App\Http\Requests\API\V1\Notification\NotificationRequest;

interface INotificationService
{
	public function getNotificationCount();

	public function getNotifications(NotificationRequest $request);
}
