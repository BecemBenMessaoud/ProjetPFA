<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Admin
 * @package App\Models
 *
 * @property int region_id
 * @property string first_name
 * @property string last_name
 * @property string email
 * @property string password
 * @property int is_superadmin
 */
class Admin extends Model
{
    use HasFactory;

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }
}
