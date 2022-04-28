<?php

namespace App\Listeners;

use App\Events\ArticleCreated;
use App\Mail\ArticleCreated as ArticleCreatedMail;
use App\Mail\SendNewArticleOnFolloewedCategoryMail as NewArticleOnCategory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewArticleOnCategorymail
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
     * @param  ArticleCreated  $event
     * @return void
     */
    public function handle(ArticleCreated $event)
    {
        //dd($event->article->category);
        foreach ($event->article->category->followers as $follower) {
            Mail::to($follower)->send(new NewArticleOnCategory($event->article));
        }
    }
}
