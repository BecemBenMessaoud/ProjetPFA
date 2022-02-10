<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Category
 * @package App\Models
 *
 * @property string type
 * @property int level
 */
class Category extends Model
{
    use HasFactory;

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

}
