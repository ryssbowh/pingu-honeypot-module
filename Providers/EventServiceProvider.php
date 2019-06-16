<?php

namespace Pingu\HoneyPot\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Pingu\Forms\Events\FormBuilt;
use Pingu\HoneyPot\Listeners\FormListener;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
    	FormBuilt::class => [FormListener::class]
    ];
}