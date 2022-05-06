<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
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

    const STATUS_NOT_AVAILABLE = 'not_available';
    const STATUS_AVAILABLE = 'available';
    const STATUS_GIVEN = 'given';
    const STATUSES = [
        self::STATUS_NOT_AVAILABLE,
        self::STATUS_AVAILABLE,
        self::STATUS_GIVEN,
    ];

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

    public function pictures ():HasMany
    {
        return $this ->hasMany( Picture::class);
    }

    public function canEdit(){
        if ($this->user_id != Auth::user()->id || $this->status !== Article::STATUS_NOT_AVAILABLE) {
            abort(403);
        }

        return true;
    }
}
