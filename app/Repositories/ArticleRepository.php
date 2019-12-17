<?php


namespace App\Repositories;


use App\Models\Article;

class ArticleRepository
{
    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|Article
     */
    public function find($id)
    {
        return Article::query()->findOrFail($id);
    }
}
