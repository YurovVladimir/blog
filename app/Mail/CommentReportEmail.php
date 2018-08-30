<?php

namespace App\Mail;

use App\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommentReportEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Comment|Collection $comment
     */
    public $comment;

    /**
     * Create a new message instance.
     *
     * @param Collection|Comment $comment
     */
    public function __construct(Collection $comment)
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
        return $this->view('emails.comments');
    }
}
