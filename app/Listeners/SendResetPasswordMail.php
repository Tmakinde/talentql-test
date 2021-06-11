<?php

namespace App\Listeners;

use App\Events\SendPasswordMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\ResetpasswordMail as resetpasswordmail;
use Mail;

class SendResetPasswordMail
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
     * @param  sendPasswordMail  $event
     * @return void
     */
    public function handle(sendPasswordMail $event)
    {
        Mail::to($event->email)->send(new resetpasswordmail($event->user, $event->token));
    }
}
