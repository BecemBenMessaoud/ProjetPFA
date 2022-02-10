<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

/**
 * Class Article
 * @package App\Models
 *
 * @property string name
 * @property Date received_at
 * @property string status
 * @property string description
 * @property string state
 */
class Article extends Model
{
    use HasFactory;
}
