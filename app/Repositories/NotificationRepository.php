<?php

namespace App\Repositories;

use App\Models\Notification;

class NotificationRepository extends BaseRepository
{
    public function __construct(Notification $model)
    {
        $this->model = $model;
    }
}
