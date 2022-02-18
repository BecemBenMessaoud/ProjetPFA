<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'level' => [Rule::in(Category::getLevels())],
            'type' => ['required', 'string']
        ]);

        $level = $request->input('level');
        $type = $request->input('type');

//        $categories = Category::all();
//        foreach ($categories as $category) {
//            if ($level == $category->level && $type == $category->type) {
//                return redirect()->to('/admin/categories');
//            }
//        }

        $exists = Category::query()->where('level', '=', $level)
            ->where('type', '=', $type)->first();

        if ($exists) {
            return redirect()->to('/admin/categories');
        }

        $category = new Category();
        $category->level = $level;
        $category->type = $type;
        $category->save();

        return redirect()->to('/admin/categories');
    }

    public function edit($categoryId)
    {
        $category = Category::query()->findOrFail($categoryId);//te5dem al id(findorFail) tjib element bark

        return view('admin.category.create', compact('category'));

    }

    public function update(Request $request, $categoryId)
    {
        $request->validate([
            'level' => [Rule::in(Category::getLevels())],
            'type' => ['required', 'string']
        ]);
        $level = $request->input('level');
        $type = $request->input('type');

        $defaultCategory = Category::query()->whereNull('level')
            ->where('type', '=', 'Other')->first();
        if ($defaultCategory->id == $categoryId) {
            abort(403);
        }

        $exists = Category::query()->where('level', '=', $level)
            ->where('id', '!=', $categoryId)
            ->where('type', '=', $type)->first();

        if ($exists) {
            return redirect()->to('/admin/categories');
        }

        $category = Category::query()->findOrFail($categoryId);//on recupére les donnes existante li chnamlou alihom lupdate
        $category->level = $level;
        $category->type = $type;
        $category->save();

        return redirect()->to('/admin/categories');


    }

    public function delete($categoryId)
    {
        $defaultCategory = Category::query()->whereNull('level')
            ->where('type', '=', 'Other')->first();
        if ($defaultCategory->id == $categoryId) {
            abort(403);
        }

        $category = Category::query()->findOrFail($categoryId);
        $articles = $category->articles; //   same thing :     $articles = Article::query()->where('category_id', '=', $categoryId)->get();
        $category->delete();
        foreach ($articles as $article) {
            $article->category_id = $defaultCategory->id;
            $article->save();
        }

        return redirect()->to('/admin/categories');
    }

}
