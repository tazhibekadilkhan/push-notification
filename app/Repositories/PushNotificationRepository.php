<?php

namespace App\Repositories;

use App\Models\PushNotification;

class PushNotificationRepository extends BaseRepository
{
    public function __construct(PushNotification $model)
    {
        $this->model = $model;
    }
}
