<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App\Models
 *
 * @property string region_id
 * @property string first_name
 * @property string last_name
 * @property string address
 * @property string email
 * @property string password
 * @property int level
 */
class User extends Authenticatable
{
    use softDeletes;
    use HasFactory;

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function givenArticles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function demands(): HasMany
    {
        return $this->hasMany(Demand::class);
    }

    public function getFullName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

}
