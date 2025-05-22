<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendPushNotificationBatchJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected int $notificationId;

    public function __construct($notificationId)
    {
        $this->notificationId = $notificationId;
    }

    public function handle(): void
    {
        Log::info('SendPushNotificationBatchJob');
        dispatch(new SendPushNotificationJob($this->notificationId));
        Log::info('SendPushNotificationBatchJobEnd');
    }
}
