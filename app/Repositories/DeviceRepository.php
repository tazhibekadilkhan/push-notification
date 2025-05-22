<?php

namespace App\Repositories;

use App\Models\Device;

class DeviceRepository extends BaseRepository
{
    public function __construct(Device $model)
    {
        $this->model = $model;
    }
}
