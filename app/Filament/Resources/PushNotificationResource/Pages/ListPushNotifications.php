<?php

namespace App\Filament\Resources\PushNotificationResource\Pages;

use App\Filament\Resources\PushNotificationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPushNotifications extends ListRecords
{
    protected static string $resource = PushNotificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }
    public function getBreadcrumbs(): array
    {
        return [
            route('filament.admin.resources.notifications.index') => 'Уведомления',
            '' => 'Пуши по уведомлению',
        ];
    }
}
