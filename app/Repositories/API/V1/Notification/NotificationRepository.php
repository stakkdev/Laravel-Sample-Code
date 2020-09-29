<?php

namespace App\Repositories\API\V1\Notification;

use App\Repositories\API\V1\Common\GenericRepository;
use App\Repositories\API\V1\Interfaces\Notification\INotificationRepository;

class NotificationRepository extends GenericRepository implements INotificationRepository
{
	public function model()
	{
		return 'App\Models\Notification';
    }
    
	public function getNotifications($user_id, $is_read = true, $pagination_record_per_page = false)
	{
		$notification =	$this->model->where('send_to', $user_id)->latest();
		if ($is_read)
			$notification->where('is_read', $is_read);

		if ($pagination_record_per_page) {
			$result = $notification->paginate($pagination_record_per_page);
		} else {
			$result = $notification->get();
		}
		if ($result->count() > 0) {
			return $result;
		}
		return false;
	}

	public function updateReadNotificationsStatus(array $notification_ids)
	{
		return $this->model->whereIn('id', $notification_ids)->update(['is_read' => true]);
	}
}
