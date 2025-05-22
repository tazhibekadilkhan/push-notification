<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\DeviceRequest;
use App\Models\Device;
use App\Services\DeviceService;
use Illuminate\Support\Facades\Auth;

class DeviceController extends Controller
{
    protected $service;
    public function __construct(DeviceService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function store(DeviceRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        return $this->service->store($data);
    }

    public function destroy(Device $device)
    {
        return $this->service->destroy($device);
    }
}
