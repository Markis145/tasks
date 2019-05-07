<?php

namespace App\Providers;

use App\Events\TaskCompleted;
use App\Events\TaskDelete;
use App\Events\TaskModify;
use App\Events\TaskUncompleted;
use App\Events\TaskStore;
use App\Listeners\AddRolesToRegisterUser;
use App\Listeners\ForgetTaskCache;
use App\Listeners\LogNotification;
use App\Listeners\LogTaskCompleted;
use App\Listeners\LogTaskDelete;
use App\Listeners\LogTaskModify;
use App\Listeners\LogTaskUncompleted;
use App\Listeners\LogTaskStore;
use App\Listeners\SendDatabaseNotificationStore;
use App\Listeners\SendMailTaskCompleted;
use App\Listeners\SendMailTaskDelete;
use App\Listeners\SendMailTaskModify;
use App\Listeners\SendMailTaskUncompleted;
use App\Listeners\SendMailTaskStore;
use App\Listeners\SendTaskCompletedNotification;
use App\Listeners\SendTaskDeleteNotification;
use App\Listeners\SendTaskStoreNotification;
use App\Listeners\SendTaskUncompletedNotification;
use App\Listeners\SendTaskUpdateNotification;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            AddRolesToRegisterUser::class
        ],
        TaskUncompleted::class => [
            LogTaskUncompleted::class,
            SendMailTaskUncompleted::class,
            ForgetTaskCache::class,
            SendTaskUncompletedNotification::class
        ],
        TaskCompleted::class => [
            LogTaskCompleted::class,
            SendMailTaskCompleted::class,
            ForgetTaskCache::class,
            SendTaskCompletedNotification::class
        ],
        TaskStore::class => [
            LogTaskStore::class,
            SendMailTaskStore::class,
            ForgetTaskCache::class,
            SendTaskStoreNotification::class
        ],
        TaskDelete::class => [
            LogTaskDelete::class,
            SendMailTaskDelete::class,
            ForgetTaskCache::class,
            SendTaskDeleteNotification::class
        ],
        TaskModify::class => [
            LogTaskModify::class,
            SendMailTaskModify::class,
            ForgetTaskCache::class,
            SendTaskUpdateNotification::class
        ],

        NotificationSent::class => [
            LogNotification::class,
            SendDatabaseNotificationStore::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
