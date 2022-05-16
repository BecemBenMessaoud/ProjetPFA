<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Demand;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandController extends Controller
{
    public function index()
    {
        $demands = Demand::query()->where('status', '=', Demand::STATUS_PENDING)->get();

        return view('admin.demand.index', compact('demands'));
    }

    public function accept($demandId)
    {
        $demand = Demand::query()->findOrFail($demandId);
        $article = $demand->article;

        if ($article->status !== Article::STATUS_AVAILABLE || $demand->status !== Demand::STATUS_PENDING) {
            return response()->json(['success' => false, 'demand' => $demand, 'message' => 'article not available'], 403);
        }

        $demandIds = [];

        $demand->status = Demand::STATUS_ACCEPTED;
        $demand->save();

        array_push($demandIds, (int)$demandId);

        $article->status = Article::STATUS_GIVEN;
        $article->save();

        $demands = Demand::query()->where('article_id', '=', $article->id)
            ->where('status', '=', Demand::STATUS_PENDING)
            ->get();

        foreach ($demands as $demand) {
            $demand->status = Demand::STATUS_REFUSED;
            $demand->save();
            array_push($demandIds, $demand->id);
        }

        return response()->json(['success' => true, 'demand_ids' => $demandIds, 'message' => 'demand accepted']);
    }

    public function refuse($demandId)
    {
        $demand = Demand::query()->findOrFail($demandId);
        $article = $demand->article;

        if ($article->status !== Article::STATUS_AVAILABLE || $demand->status !== Demand::STATUS_PENDING) {
            abort(403);
        }

        $demand->status = Demand::STATUS_REFUSED;
        $demand->save();
        return response()->json(['success' => true, 'message' => 'demand refused']);

    }
}
