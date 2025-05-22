<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NotificationResource\Pages;
use App\Models\Notification;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Tables\Actions\Action;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class NotificationResource extends Resource
{
    protected static ?string $model = Notification::class;
    protected static ?string $navigationIcon = 'heroicon-o-bell';
    protected static ?string $navigationGroup = 'Уведомления';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required()->maxLength(255),
                Textarea::make('message')->required()->rows(4),
                DateTimePicker::make('send_at')
                    ->label('Дата и время отправки')
                    ->displayFormat('d.m.Y H:i:s')  // отображение в форме
                    ->format('d.m.Y H:i:s')         // формат для сохранения в БД
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Заголовок')->searchable(),
                TextColumn::make('message')->label('Сообщение')->limit(50),
                TextColumn::make('send_at')
                    ->label('Дата отправки')
                    ->formatStateUsing(fn($state) => Carbon::parse($state)->format('d.m.Y H:i:s'))
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Статус')
                    ->badge()
                    ->colors([
                        'primary' => 'pending',
                        'success' => 'sent',
                        'danger'  => 'failed',
                    ])
                    ->formatStateUsing(function (string $state) {
                        return match ($state) {
                            'pending' => 'Ожидает',
                            'sent' => 'Доставлено',
                            'failed' => 'Ошибка',
                            default => $state,
                        };
                    })
                    ->sortable()
                    ->searchable(query: function (Builder $query, string $search) {
                        $mapping = [
                            'ожидает' => 'pending',
                            'доставлено' => 'sent',
                            'ошибка' => 'failed',
                        ];

                        $search = mb_strtolower($search);
                        $status = $mapping[$search] ?? null;

                        if ($status) {
                            $query->where('status', $status);
                        } else {
                            // Если поиск по другим полям, можно оставить пустым или добавить дополнительные условия
                            $query->whereRaw('0=1'); // чтобы ничего не возвращать, если статус не совпал
                        }
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Action::make('viewPushes')
                    ->label('Устройства')
                    ->icon('heroicon-o-device-phone-mobile')
                    ->url(fn(Notification $record) => PushNotificationResource::getUrl('index', [
                        'notification_id' => $record->id,
                    ]))
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index'  => Pages\ListNotifications::route('/'),
            'create' => Pages\CreateNotification::route('/create'),
//            'edit' => Pages\EditNotification::route('/{record}/edit'),
        ];
    }
}
