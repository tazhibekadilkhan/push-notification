<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\NotificationRequest;
use App\Models\Notification;
use App\Services\NotificationService;

class NotificationController extends Controller
{
    protected $service;

    public function __construct(NotificationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function store(NotificationRequest $request)
    {
        return $this->service->store($request->validated());
    }

    public function destroy(Notification $notification)
    {
        return $this->service->destroy($$notification);
    }
}
