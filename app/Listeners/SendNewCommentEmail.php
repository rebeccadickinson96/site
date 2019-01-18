<?php

namespace App\Listeners;

use App\Events\CommentPosted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendNewCommentEmail
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
     * @param  CommentPosted  $event
     * @return void
     */
    public function handle(CommentPosted $event)
    {
        Mail::to('bexy-d@hotmail.com')->send(new \App\Mail\SendNewCommentEmail($event->comment));
    }
}
