<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Mail\PostCreated as PostCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPostCreatedNotification
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
     * @param  PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        // 190610 marked by Yong
        // Mail::to($event->post->user->email)->send(
        //     new PostCreatedMail($event->post)
        // );
    }
}
