<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Date;

/**
 * Class Article
 * @package App\Models
 *
 * @property int category_id
 * @property int user_id
 * @property string name
 * @property Date received_at
 * @property string status
 * @property string description
 * @property string state
 */
class Article extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function demands(): HasMany
    {
        return $this->hasMany(Demand::class);
    }
}
