<?php

namespace App\Jobs;

use App\Mail\ArticleReminder;
use App\Models\Article;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;


class SendReminderMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::all();

        $users->each(function ($user) {
            $newArticlesForUser = Article::query()
                ->whereIn('category_id', $user->followed_categories()->pluck('id'))
                ->where('created_at', '>=', now()->subWeek())
                ->orderBy('created_at', 'ASC')
                ->get();

            if ($newArticlesForUser->count() > 0) {
                Mail::to($user)->send(new ArticleReminder($user, $newArticlesForUser));
            }
        });
    }
}
