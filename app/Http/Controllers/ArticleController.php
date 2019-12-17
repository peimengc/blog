<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('articles.index');
    }

    public function show($id)
    {
        return view('articles.show',compact('id'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function edit($id)
    {
        return view('articles.create',compact('id'));
    }
}
