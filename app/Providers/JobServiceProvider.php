<?php

namespace App\Providers;

use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Queue\Events\JobQueued;
use Illuminate\Support\ServiceProvider;

class JobServiceProvider extends ServiceProvider
{
    protected $listen = [
        JobQueued::class => [
            \App\Listeners\UpdateJobRecordListener::class,
        ],
        JobProcessing::class => [
            \App\Listeners\UpdateJobRecordListener::class,
        ],
        JobProcessed::class => [
            \App\Listeners\UpdateJobRecordListener::class,
        ],
        JobFailed::class => [
            \App\Listeners\UpdateJobRecordListener::class,
        ],
    ];
}
