<?php

namespace App\Observers;

use App\Jobs\SendPushNotificationJob;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;

class NotificationObserver
{
    public function created(Notification $notification): void
    {
        if ($notification->sent_at == null) {
            Log::info('NotificationObserver');
            dispatch(new SendPushNotificationJob($notification->id));
            Log::info('NotificationObserverEnd');
        }
    }
}

