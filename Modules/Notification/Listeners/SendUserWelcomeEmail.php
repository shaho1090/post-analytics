<?php

namespace Notification\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Queue\Attributes\Queue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Notification\Mails\WelcomeEmail;
use User\Events\UserRegistered;

#[Connection('redis')]
#[Queue('listeners')]
class SendUserWelcomeEmail implements ShouldQueue
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
    public function handle(UserRegistered $event): void
    {
        Mail::to($event->email)
            ->send(new WelcomeEmail($event->name));
        //just for testing purpose
        Log::info("User '{$event->email}' registered.");
    }
}
