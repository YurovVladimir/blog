<?php

namespace App\Console\Commands;

use App\Mail\CommentReportEmail;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

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
        $userIds = Post::whereHas('comments', function ($query) use ($days) {
            $query->where('created_at', '>', Carbon::now()->subDays($days));
        })->with(['comments' => function ($query) use ($days) {
            $query->where('created_at', '>', Carbon::now()->subDays($days));
        }])->get()->groupBy('user_id');
        foreach ($userIds as $userId => $posts) {
            if ($user = User::find($userId)) {
                $this->info("send report to user $user->name");
                Mail::to($user)
                    ->send(new CommentReportEmail($posts));
            }
        }
    }
}
