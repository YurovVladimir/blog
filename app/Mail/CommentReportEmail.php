<?php

namespace App\Mail;

use App\Models\Comment;
use App\Exports\CommentsExport;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class CommentReportEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Post|Collection $posts
     */
    public $posts;

    /**
     * Create a new message instance.
     *
     * @param Collection|Post $posts
     */
    public function __construct(Collection $posts)
    {
        $this->posts = $posts;
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
        foreach ($this->posts as $post) {
            if ($post->comments->count() > 5) {
                $export_path = 'exports/comments.xlsx';
                Excel::store(new CommentsExport($post->comments), $export_path);
                $this->attach(\Storage::path($export_path));
            }
        }
        return $this->view('emails.comments');
    }
}
