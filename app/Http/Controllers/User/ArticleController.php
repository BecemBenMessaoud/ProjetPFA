<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateArticleRequest;
use App\Models\Article;
use App\Models\Demand;
use App\Models\User;
use App\Repositories\ArticleRepository;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function create(CreateArticleRequest $request): JsonResponse
    {
        $categoryId = $request->input('category_id');
        $name = $request->input('name');
        $description = $request->input('description');
        $state = $request->input('state');
        $userId = Auth::user()->id;

        $isCreated = ArticleRepository::create($userId, $categoryId, $name, $description, $state);

        if ($isCreated) {
            return response()->json(['success' => true, 'message' => 'article created']);
        } else {
            return response()->json(['success' => false, 'message' => 'article not created'], 400);
        }
    }

    public function edit()
    {

    }

    public function delete($id): JsonResponse
    {
        $article = Article::query()->find($id);
        if (!$article) {
            return response()->json(['succes' => false, 'message' => 'article not found'], 404);
        }

        $user = Auth::user();
        if ($user->id != $article->user_id) {
            return response()->json(['succes' => false, 'message' => 'article does not belong to user'], 403);
        }

        $status = $article->status;
        if (in_array($status, [Article::STATUS_GIVEN, Article::STATUS_AVAILABLE])) {
            return response()->json(['succes' => false, 'message' => 'article is not available'], 403);
        }

        $isDeleted = $article->delete();
        if ($isDeleted) {
            return response()->json(['succes' => true, 'message' => 'article deleted']);
        } else {
            return response()->json(['succes' => false, 'message' => 'article could not be deleted'], 400);
        }
    }

    public function available(Request $request)
    {
        $type = $request->input('type');
        $level = $request->input('level');

        $articles = ArticleRepository::available($type, $level);

        return $articles;
    }

    public function given($status)
    {
        $user = Auth::user();

        $articles = $user->givenArticles();

        if (in_array($status, Article::STATUSES)) {
            $articles->where('status', '=', $status);
        }

        return $articles->get();
    }

    public function collected()
    {
        $user = Auth::user();

        return Article::query()->whereHas('demands', function (Builder $demandQuery) use ($user) {
            $demandQuery->where('status', '=', Demand::STATUS_ACCEPTED)
                ->where('user_id', '=', $user->id);
        })->get();
    }

}
