<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Picture;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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
            'description' => ['required', 'string', 'max:50'],
            'state' => ['required', 'string', 'max:20'],
        ]);

        $categoryId = $request->input('category_id');
        $exist = Category::query()->find($categoryId);
        if (!$exist) {
            return redirect('/user/articles/');
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

        return redirect('/user/articles/' . $article->id . '/pictures');
    }

    public function edit($articleId)
    {
        $article = Article::query()->findOrFail($articleId);

        $article->canEdit();

        $categories = Category::all();

        return view('user.article.create', compact('article', 'categories'));
    }

    public function delete($articleId)
    {
        $article = Article::query()->findOrFail($articleId);

        $article->canEdit();

        foreach ($article->pictures as $picture) {
            $this->deletePicture($picture->id);
        }

        $article->delete();

        return redirect('/user/articles/given');
    }

    public function update($articleId, Request $request)
    {
        $article = Article::query()->findOrFail($articleId);

        $article->canEdit();

        $request->validate([
            'category_id' => ['required', 'int'],
            'name' => ['required', 'string', 'max:20'],
            'description' => ['required', 'string', 'max:50'],
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

        return redirect('/user/articles/' . $article->id . '/pictures');
    }

    public function pictures($articleId)
    {
        $article = Article::query()->findOrFail($articleId);
        $article->canEdit();

        $article = Article::query()->findOrFail($articleId);
        $pictures = $article->pictures()->select(['id', 'name'])->get();

        return view('user.article.pictures', compact('article', 'pictures'));
    }

    public function addPicture(Request $request, $articleId)
    {
        $article = Article::query()->findOrFail($articleId);
        $article->canEdit();

        $request->validate([
            'picture' => 'required|image|mimes:jpg,png,jpeg',
        ]);

        $picture = $request->file('picture');
        $ext = $picture->extension();
        $name = uniqid('pic_') . '.' . $ext;
        $picture->move(public_path('pictures'), $name);

        $picture = new Picture();
        $picture->article_id = $articleId;
        $picture->name = $name;
        $picture->save();

        return redirect('/user/articles/' . $article->id . '/pictures');
    }

    public function deletePicture($pictureId)
    {
        $picture = Picture::query()->findOrFail($pictureId);
        $article = $picture->article;
        $article->canEdit();

        $picture->delete();
        File::delete(public_path("pictures/" . $picture->name));

        return redirect('/user/articles/' . $article->id . '/pictures');
    }

    public function given()
    {
        $user = Auth::user();
        $articles = Article::query()->where('user_id', '=', $user->id)->get();

        return view('user.article.given', compact('articles'));
    }
}
