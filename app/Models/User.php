<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App\Models
 *
 * @property string first_name
 * @property string last_name
 * @property string address
 * @property string email
 * @property string password
 * @property int level
 */
class User extends Authenticatable
{
    use HasFactory;
}
