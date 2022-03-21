<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('user.article.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => ['required', 'int'],
            'name' => ['required', 'string', 'max:20'],
            'description' => ['required', 'text', 'max:50'],
            'state' => ['required', 'string', 'max:20'],
        ]);

        $categoryId = $request->input('category_id');
        $exist = Category::query()->find($categoryId);
        if (!$exist) {
            return redirect('/user/articles/create');
        }
        $name = $request->input('name');
        $description = $request->input('description');
        $state = $request->input('state');

        $article = new Article();
        $article->category_id = $categoryId;
        $article->user_id = Auth::user()->id;
        $article->name = $name;
        $article->received_at = null;
        $article->description = $description;
        $article->status = Article::STATUS_NOT_AVAILABLE;
        $article->state = $state;
        $article->save();

    }

    public function edit($articleId)
    {
        $article = Article::query()->findOrFail($articleId);

        $this->canEdit($article);

        $categories = Category::all();

        return view('user.article.create', compact('article', 'categories'));
    }

    public function delete($articleId)
    {
        $article = Article::query()->findOrFail($articleId);

        $this->canEdit($article);

        $article->delete();
    }

    public function update($articleId, Request $request)
    {
        $article = Article::query()->findOrFail($articleId);

        $this->canEdit($article);

        $request->validate([
            'category_id' => ['required', 'int'],
            'name' => ['required', 'string', 'max:20'],
            'description' => ['required', 'text', 'max:50'],
            'state' => ['required', 'string', 'max:20'],
        ]);

        $categoryId = $request->input('category_id');
        $exist = Category::query()->find($categoryId);
        if (!$exist) {
            return redirect('/user/articles/create');
        }

        $name = $request->input('name');
        $description = $request->input('description');
        $state = $request->input('state');

        $article->category_id = $categoryId;
        $article->name = $name;
        $article->description = $description;
        $article->state = $state;
        $article->save();
    }

    public function deletePicture()
    {

    }

    public function addPicture(Request $request)
    {
     $request->validate([
         'i'

     ]) ;


    }

    private function canEdit($article)
    {
        if ($article->user_id !== Auth::user()->id || $article->status !== Article::STATUS_NOT_AVAILABLE) {
            abort(403);
        }
    }


}
