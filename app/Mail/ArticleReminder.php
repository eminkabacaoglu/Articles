<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class ArticleReminder extends Mailable 
{
    use Queueable, SerializesModels;

    public $user;
    public $articles;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,Collection $articles)
    {
        $this->user=$user;
        $this->articles=$articles;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Hey ' . $this->user->name . '! ' . $this->articles->count() . ' new post for you!')
            ->markdown('emails.articles.reminder');
    }
}
