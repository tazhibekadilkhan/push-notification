<?php

namespace App\Console\Commands;

use App\Jobs\SendPushNotificationBatchJob;
use App\Jobs\SendPushNotificationJob;
use App\Models\Notification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendScheduledPushNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-scheduled-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('start of notification schedule');
        $notifications = Notification::where('status', 'pending')
            ->where('send_at', '!=', null)
            ->where('send_at', '<=', now())
            ->where('status', 'pending')
            ->get();

        foreach ($notifications as $notification) {
            dispatch(new SendPushNotificationJob($notification->id));
        }
        Log::info('end of notification schedule');
    }

}
