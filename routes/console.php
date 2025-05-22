<?php

use App\Console\Commands\SendScheduledPushNotifications;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new SendScheduledPushNotifications())->everyMinute();
