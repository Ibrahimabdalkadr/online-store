<?php

namespace App\Listeners;

use App\Events\SupportMessageSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SupportMessageSentListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SupportMessageSentListener $event): void
    {
        //
    }
}
