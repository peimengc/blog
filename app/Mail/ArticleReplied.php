<?php

namespace App\Mail;

use App\Models\Reply;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ArticleReplied extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public  $reply;

    /**
     * ArticleReplied constructor.
     * @param Reply $reply
     */
    public function __construct(Reply $reply)
    {
        $this->reply = $reply->load('user','article.author');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.articles.replied');
    }
}
