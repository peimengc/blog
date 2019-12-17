<h3>{{ config('app.name') }}</h3>
<p>
    您在本博客发的文章 <a href="{{ route('articles.show',$reply->article->id) }}">{{ $reply->article->title }}</a>有人回复，点击查看详情
</p>
