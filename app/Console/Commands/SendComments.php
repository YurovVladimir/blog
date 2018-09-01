<?php

namespace App\Console\Commands;

use App\Comment;
use App\Exports\CommentsExport;
use App\Mail\CommentReportEmail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class SendComments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:comments {days=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $days = $this->argument('days');
        $comments = Comment::where('created_at', '>', Carbon::now()->subDays($days))->get();
        Mail::to('vovamadlion@yandex.ru')
            ->send(new CommentReportEmail($comments));
    }
}
