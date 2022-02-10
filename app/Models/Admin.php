<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Admin
 * @package App\Models
 *
 * @property string first_name
 * @property  string last_name
 * @property  string email
 * @property  string password 
 *
 */
class Admin extends Model
{
    use HasFactory;
}
