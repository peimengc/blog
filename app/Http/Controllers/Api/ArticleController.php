<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::query()
            ->when($request->query('search'),function (Builder $builder,$search) {
                $builder->where('title','like',"%{$search}%");
            })
            ->orderBy('created_at','desc')
            ->paginate();

        return [
            'status_code' => 0,
            'status_msg' => 'success',
            'data' => $articles
        ];
    }

    public function show($id)
    {
        $article = Article::query()->with(['author','replies.user'])->findOrFail($id);

        return [
            'status_code' => 0,
            'status_msg' => 'success',
            'data' => $article
        ];
    }

    public function store(ArticleRequest $request, Article $article)
    {
        $article->author()->associate($request->user());
        $article->fill($request->all())->save();

        return [
            'status_code' => 0,
            'status_msg' => '创建成功',
            'data' => $article->toArray()
        ];
    }

    public function update(ArticleRequest $request, $id)
    {
        $article = Article::query()->findOrFail($id);
        $article->fill($request->all())->save();

        return [
            'status_code' => 0,
            'status_msg' => '编辑成功',
            'data' => $article
        ];
    }

    public function destroy($id)
    {
        $article = Article::query()->findOrFail($id);
        $article->delete();
        return [
            'status_code' => 0,
            'status_msg' => 'deleted',
        ];
    }
}
