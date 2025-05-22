<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Notification extends Model
{
    protected $fillable = ['title', 'message', 'send_at', 'status',];

    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }

    public function setSendAtAttribute($value): void
    {
        $this->attributes['send_at'] = $value ? Carbon::createFromFormat('d.m.Y H:i:s', $value)->format('Y-m-d H:i:s') : null;
    }

    public function getSendAtAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d.m.Y H:i:s') : null;
    }
}
