<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::query()->where('status', '=', Article::STATUS_NOT_AVAILABLE)->get();
        return view('admin.article.index', compact('articles'));

    }

    public function accept($articleId)
    {
        $article = Article::query()->findOrFail($articleId);
        if ($article->status !== Article::STATUS_NOT_AVAILABLE) {
            return response()->json(['success' => false, 'article' => $article, 'message' => 'article not available'], 403);
        }
        $article->status = Article::STATUS_AVAILABLE;
        $article->save();
        return response()->json(['success' => true, 'article' => $article, 'message' => 'article accepted']);


    }

    public function refuse($articleId)
    {
        $article = Article::query()->findOrFail($articleId);
        if ($article->status !== Article::STATUS_NOT_AVAILABLE) {
            abort(403);
        }
        $article->delete();

        return response()->json(['success' => true, 'message' => 'article deleted']);

    }
}

