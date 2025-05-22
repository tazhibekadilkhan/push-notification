<?php

namespace App\Services;

use App\Repositories\NotificationRepository;
use Kreait\Firebase\Factory;

final class NotificationService extends CrudService
{
    protected $messaging;
    public function __construct(NotificationRepository $repository)
    {
        $this->repository = $repository;
        $serviceAccountPath = storage_path('tredo-3cc05-firebase-adminsdk-fbsvc-31520a73bc.json');
        $factory = (new Factory())->withServiceAccount($serviceAccountPath);
        $this->messaging = $factory->createMessaging();
    }
}
