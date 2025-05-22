<?php

namespace App\Services;

use App\Repositories\DeviceRepository;

final class DeviceService extends CrudService
{
    public function __construct(DeviceRepository $repository)
    {
        $this->repository = $repository;
    }
}
