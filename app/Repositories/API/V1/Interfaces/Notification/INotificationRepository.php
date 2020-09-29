<?php

namespace App\Repositories\API\V1\Interfaces\Notification;

use App\Repositories\API\V1\Interfaces\Common\IGenericRepository;

interface INotificationRepository extends IGenericRepository
{
	public function getNotifications($user_id, $is_read = true, $pagination_record_per_page = false);

    public function updateReadNotificationsStatus(array $notification_ids);
}
