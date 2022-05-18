<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Demand;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandController extends Controller
{
    public function getDemand($demandId)
    {
        $demand = Demand::query()->findOrFail($demandId);

        return response()->json($demand, 200);

    }

    public function store(Request $request, $articleId)
    {
        $request->validate([
            'motive' => ['required', 'string', 'max:400'],
        ]);

        $article = Article::query()->findOrFail($articleId);

        if ($article->status !== Article::STATUS_AVAILABLE) {
            return response()->json(['success' => false, 'message' => 'article not available'], 403);
        }

        $user = Auth::user();

        $demand = Demand::query()->where('user_id', '=', $user->id)
            ->where('article_id', '=', $articleId)
            ->first();

        if ($demand) {
            return response()->json(['success' => false, 'message' => 'already made demand on this article'], 403);
        }


        $motive = $request->input('motive');

        $demand = new Demand();
        $demand->user_id = $user->id;
        $demand->article_id = $articleId;
        $demand->motive = $motive;
        $demand->status = Demand::STATUS_PENDING;
        $demand->save();

        return response()->json(['success' => true, 'message' => 'demand created'], 201);
    }

    public function update(Request $request, $demandId)
    {
        $request->validate([
            'motive' => ['required', 'string', 'max:400'],
        ]);

        $demand = Demand::query()->findOrFail($demandId);
        $userId = Auth::user()->id;

        if ($demand->status !== Demand::STATUS_PENDING || $userId !== $demand->user_id) {
            return response()->json(['success' => false, 'message' => 'article not available'], 403);
        }

        $motive = $request->input('motive');

        $demand->motive = $motive;
        $demand->save();

        $demand->motive = $demand->getMotive();

        return response()->json(['success' => true, 'demand' => $demand, 'message' => 'demand updated'], 203);
    }

    public function delete($demandId)
    {
        $demand = Demand::query()->findOrFail($demandId);
        $userId = Auth::user()->id;

        if ($demand->status !== Demand::STATUS_PENDING || $userId !== $demand->user_id) {
            abort(403);
        }

        $demand->delete();

        return response()->json(['success' => true, 'message' => 'demand deleted']);
    }
}
