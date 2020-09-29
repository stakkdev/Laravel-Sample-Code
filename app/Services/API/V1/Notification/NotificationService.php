<?php

namespace App\Services\API\V1\Notification;

use Illuminate\Support\Facades\Auth;
use App\Enums\API\V1\Common\PaginateType;
use App\Traits\API\V1\Common\APIResponse;
use App\Exceptions\API\V1\RecordNotFoundException;
use App\Http\Requests\API\V1\Notification\NotificationRequest;
use App\Http\Resources\API\V1\Notification\NotificationResource;
use App\Services\API\V1\Interfaces\Notification\INotificationService;
use App\Repositories\API\V1\Interfaces\Notification\INotificationRepository;

class NotificationService implements INotificationService
{
	use APIResponse;

	private $iNotificationRepository;

	public function __construct(INotificationRepository $iNotificationRepository)
	{
		$this->iNotificationRepository = $iNotificationRepository;
	}
			
	/**
	 * getNotificationCount
	 *
	 * @return void
	 */
	public function getNotificationCount()
	{
		$notification = $this->iNotificationRepository->getNotifications(Auth::user()->id);
		if (!$notification)
			throw new RecordNotFoundException(trans('api/notification.no_notification_found'));
		return ['notification_count' => $notification->count()];
	}

	/**
	 * getNotifications
	 * 
	 * Get all notification	
	 *
	 * @param  mixed $request
	 * @return void
	 */
	public function getNotifications(NotificationRequest $request)
	{
		$record_per_page = $request->item_per_page  ?? PaginateType::PAGINATE_DEFAULT_PER_PAGE;
		$notification = $this->iNotificationRepository->getNotifications(Auth::user()->id, false, $record_per_page);
		if (!$notification)
			throw new RecordNotFoundException(trans('api/notification.notification_not_found'));

		$read_notification = $notification->where('is_read', false)->pluck('id')->toArray();
		// update the status to read
		$this->iNotificationRepository->updateReadNotificationsStatus($read_notification);
		return NotificationResource::collection($notification);
	}
}
