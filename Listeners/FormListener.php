<?php

namespace Pingu\HoneyPot\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Pingu\Forms\Support\Macro;
use Pingu\HoneyPot\Forms\HoneyPot;

class FormListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if(!config('honeypot.enabled')){
            return;
        }
        $event->form->addField(config('honeypot.fieldName'),[
            'field' => HoneyPot::class
        ]);
    }
}
