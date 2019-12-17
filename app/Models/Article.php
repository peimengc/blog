<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Article extends Model
{
    use Searchable;

    protected $fillable = [
        'title',
        'contents',
    ];

    //文章作者关联
    public function author()
    {
        return $this->belongsTo(User::class,'author_id','id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class,'article_id','id');
    }
}
