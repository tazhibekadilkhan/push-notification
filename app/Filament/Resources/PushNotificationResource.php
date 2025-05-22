<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PushNotificationResource\Pages;
use App\Models\PushNotification;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PushNotificationResource extends Resource
{
    protected static ?string $model = PushNotification::class;

//    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

//    protected static ?string $navigationGroup = 'Уведомления';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(function (): Builder {
                $notificationId = request('notification_id');
                return PushNotification::query()
                    ->where('notification_id', $notificationId);
            })
            ->columns([
                TextColumn::make('notification.title')->label('Уведомление'),
                TextColumn::make('device.token')->limit(50)->label('Устройство'),
                TextColumn::make('status')
                    ->label('Статус')
                    ->badge()
                    ->colors([
                        'success' => 'sent',
                        'danger'  => 'failed',
                    ])
                    ->formatStateUsing(function (string $state) {
                        return match ($state) {
                            'sent' => 'Доставлено',
                            'failed' => 'Ошибка',
                            default => $state,
                        };
                    }),
                TextColumn::make('response')->label('Ответ')->limit(50),
            ])
            ->filters([
                //
            ])
            ->actions([
//                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function canViewAny(): bool
    {
        return request()->has('notification_id');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPushNotifications::route('/'),
//            'create' => Pages\CreatePushNotification::route('/create'),
//            'edit'   => Pages\EditPushNotification::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}
