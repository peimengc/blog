<?php

namespace App\Notifications;

use App\Models\Reply;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ArticleReplied extends Notification implements ShouldQueue
{
    use Queueable;

    protected $reply;

    /**
     * ArticleReplied constructor.
     * @param Reply $reply
     */
    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database','broadcast'];
    }

    /**
     * @param $notifiable
     * @return \App\Mail\ArticleReplied
     */
    public function toMail($notifiable)
    {
        return (new \App\Mail\ArticleReplied($this->reply))->to($this->reply->article->author);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return $this->reply->toArray();
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'data' => $this->reply
        ]);
    }
}
