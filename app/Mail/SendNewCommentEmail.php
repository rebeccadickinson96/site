<?php

namespace App\Mail;

use App\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewCommentEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $comment;

    /**
     * SendNewCommentEmail constructor.
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.new-comment')->subject('New Comment')->with([
            'comment' => $this->comment,
        ]);
    }
}
