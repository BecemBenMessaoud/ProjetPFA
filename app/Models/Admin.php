<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    const DEFAULT_ADMIN = [
        'first_name' => 'SUPER',
        'last_name' => 'ADMIN',
        'email' => 'superadmin@test.com',
        'password' => 'test1234',
        'is_superadmin' => 1
    ];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function isSuperAdmin()
    {
        return $this->is_superadmin == 1;
    }

    public function isDefaultSuperAdmin()
    {
        return $this->email == self::DEFAULT_ADMIN['email'];
//        if ($this->email == self::DEFAULT_ADMIN['email']) {
//            return true;
//        } else
//            return false;
    }
}
