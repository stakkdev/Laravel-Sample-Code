<?php

namespace App\Traits\API\V1\Notification;

// load Custom Requests
use App\Http\Requests\API\V1\Notification\NotificationRequest;

use App\Services\API\V1\Interfaces\Notification\INotificationService;

trait NotificationActions
{
	private $iNotificationService;

	public function __construct(INotificationService  $iNotificationService)
	{
		$this->iNotificationService = $iNotificationService;
	}
		
	/**
	 * getNotificationCount
	 *
	 * @return void
	 */
	public function getNotificationCount()
	{
		return $this->iNotificationService->getNotificationCount();
	}
	
	/**
	 * getNotifications
	 *
	 * @param  mixed $request
	 * @return void
	 */
	public function getNotifications(NotificationRequest $request)
	{
		return $this->iNotificationService->getNotifications($request);
	}
}
