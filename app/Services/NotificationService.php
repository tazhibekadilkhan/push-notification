<?php

namespace App\Services;

use App\Repositories\NotificationRepository;

final class NotificationService extends CrudService
{
    public function __construct(NotificationRepository $repository)
    {
        $this->repository = $repository;
    }
}
