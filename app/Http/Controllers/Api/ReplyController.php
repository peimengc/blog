<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;
use App\Mail\ArticleReplied;
use App\Repositories\ArticleRepository;
use App\Repositories\ReplyRepository;
use Mail;

class ReplyController extends Controller
{
    public function store(ReplyRequest $request,
                          ArticleRepository $articleRepository,
                          ReplyRepository $replyRepository,
                          $articleId)
    {
        $article = $articleRepository->find($articleId);

        $reply = $replyRepository->add($article,$request->all(),$request->user());

        $article->author->notify(new \App\Notifications\ArticleReplied($reply));

        return [
            'status_code' => 0,
            'status_msg' => '回复成功',
            'data' => $reply->toArray()
        ];
    }
}
