<?php


namespace App\Repositories;


use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class ArticleRepository
{
    public static function create($userId, $categoryId, $name, $description, $state): bool
    {
        $article = new Article();
        $article->user_id = $userId;
        $article->category_id = $categoryId;
        $article->name = $name;
        $article->received_at = null;
        $article->status = Article::STATUS_NOT_AVAILABLE;
        $article->description = $description;
        $article->state = $state;

        return $article->save();
    }

    public static function available($type = null, $level = null)
    {
        $articles = Article::query()->where('status', '=', Article::STATUS_AVAILABLE);

        if ($type) {
            $articles->whereHas('category', function (Builder $categoryQuery) use ($type) {
                $categoryQuery->where('type', '=', $type);
            });
        }

        if ($level) {
            $articles->whereHas('category', function (Builder $categoryQuery) use ($level) {
                $categoryQuery->where('level', '=', $level)
                    ->orWhereNull('level');
            });
        }

        return $articles->get();

    }
}
