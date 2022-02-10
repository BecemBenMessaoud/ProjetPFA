<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Region
 * @package App\Models
 *
 * @property string name
 * @property int postal_code
 */
class Region extends Model
{
    use HasFactory;

    public function admins(): HasMany
    {
        return $this->hasMany(Admin::class);
    }

    public function users(): HasMany
{
    return $this->hasMany(User::class);
}

}
