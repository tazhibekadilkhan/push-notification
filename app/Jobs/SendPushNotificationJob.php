<?php

namespace App\Jobs;

use App\Models\Device;
use App\Models\Notification;
use App\Models\PushNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;

class SendPushNotificationJob implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    protected int $notificationId;

    public function __construct(int $notificationId)
    {
        $this->notificationId = $notificationId;
    }

    public function handle(): void
    {
        try {
            $notification = Notification::findOrFail($this->notificationId);

            $messaging = $this->createMessagingInstance();
            $devices = $this->getDevicesWithTokens();
            $tokenToDeviceId = $devices->pluck('id', 'token')->toArray();
            $tokens = array_keys($tokenToDeviceId);

            if (empty($tokens)) {
                Log::warning("Нет токенов для отправки уведомления #{$notification->id}");
                return;
            }

            $firebaseNotification = FirebaseNotification::create($notification->title, $notification->message);
            $message = CloudMessage::new()
                ->withNotification($firebaseNotification)
                ->withData([
                    'title' => $notification->title,
                    'body'  => $notification->message,
                ]);

            $report = $messaging->sendMulticast($message, $tokens);

            $this->logAndStoreResults($report, $tokenToDeviceId);

            $this->updateNotificationStatusIfSuccessful($notification, $report, count($tokens));

        } catch (\Exception $e) {
            Log::error("Ошибка при отправке уведомления #{$this->notificationId}: " . $e->getMessage());
        }
    }

    protected function createMessagingInstance(): \Kreait\Firebase\Messaging
    {
        $serviceAccountPath = storage_path('tredo-3cc05-firebase-adminsdk-fbsvc-31520a73bc.json');
        return (new Factory())->withServiceAccount($serviceAccountPath)->createMessaging();
    }

    protected function getDevicesWithTokens()
    {
        return Device::whereNotNull('token')->get(['id', 'token']);
    }

    protected function logAndStoreResults($report, array $tokenToDeviceId): void
    {
        foreach ($report->successes()->getItems() as $success) {
            $token = $success->target()->value();
            if (isset($tokenToDeviceId[$token])) {
                PushNotification::create([
                    'notification_id' => $this->notificationId,
                    'device_id'       => $tokenToDeviceId[$token],
                    'status'          => 'sent',
                ]);
            }
        }

        foreach ($report->failures()->getItems() as $failure) {
            $token = $failure->target()->value();
            if (isset($tokenToDeviceId[$token])) {
                PushNotification::create([
                    'notification_id' => $this->notificationId,
                    'device_id'       => $tokenToDeviceId[$token],
                    'status'          => 'failed',
                    'response'        => $failure->error()->getMessage(),
                ]);
            }

            Log::error("Ошибка при отправке на токен {$token}: " . $failure->error()->getMessage());
        }
    }

    protected function updateNotificationStatusIfSuccessful(Notification $notification, $report, int $total): void
    {
        $successCount = $report->successes()->count();
        $successRate = $total > 0 ? ($successCount / $total) * 100 : 0;

        Log::info("Успешно отправлено: {$successCount} из {$total} ({$successRate}%)");

        if ($successRate >= 75) {
            $notification->update(['status' => 'sent']);
            Log::info("Уведомление #{$notification->id} обновлено как 'sent'");
        }
    }

}

