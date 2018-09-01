<?php

namespace App\Mail;

use App\Comment;
use App\Exports\CommentsExport;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class CommentReportEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Comment|Collection $comment
     */
    public $comments;

    /**
     * Create a new message instance.
     *
     * @param Collection|Comment $comments
     */
    public function __construct(Collection $comments)
    {
        $this->comments = $comments;
    }

    /**
     * Build the message.
     *
     * @return $this
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function build()
    {
        if ($this->comments->count() > 5) {
            $export_path = 'exports/comments.xlsx';
            Excel::store(new CommentsExport($this->comments), $export_path);
            $this->attach(\Storage::path($export_path));
        }
        return $this->view('emails.comments');
    }
}
