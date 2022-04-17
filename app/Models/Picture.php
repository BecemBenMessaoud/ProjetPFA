<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Picture
 * @package App\Models
 *
 * @property string name
 * @property int article_id
 */
class Picture extends Model
{
    use HasFactory;

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
