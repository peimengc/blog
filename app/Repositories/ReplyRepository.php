<?php


namespace App\Repositories;


use App\Models\Article;
use App\Models\Reply;
use App\Models\User;

class ReplyRepository
{
    /**
     * @param Article $article
     * @param $attr
     * @param User $user
     * @return Reply
     */
    public function add(Article $article, $attr, User $user)
    {
        $reply = new Reply($attr);
        $reply->article()->associate($article);
        $reply->user()->associate($user);
        $reply->save();

        return $reply;
    }
}
