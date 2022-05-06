<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Demand;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DemandController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('user.demand.create', compact('articles'));
    }

    public function store(Request $request, $articleId)
    {
        $request->validate([
            'motive' => ['required', 'string', 'max:50'],
        ]);

        Article::query()->findOrFail($articleId);


        $motive = $request->input('motive');
        $userId = Auth::user()->id;

        $demand = new Demand();
        $demand->user_id = $userId;
        $demand->article_id = $articleId;
        $demand->motive = $motive;
        $demand->status = Demand::STATUS_PENDING;
        $demand->save();

        // Redirect to requested articles.
    }

    public function delete($demandId)
    {
        $demand = Demand::query()->findOrFail($demandId);

        if ($demand->status !== Demand::STATUS_PENDING) {
            abort(403);
        }

        $userId = Auth::user()->id;

        if ($userId !== $demand->user_id) {
            abort(403);
        }

        $demand->delete();
    }
}
