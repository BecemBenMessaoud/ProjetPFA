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
    public $timestamps = false;
    use HasFactory;

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public static function getLevels()
    {
        $levels[] = null;

        for ($i = 1; $i <= 13; $i++) {
            $levels[] = $i;
        }

        return $levels;
    }

    public static function getLevelLabel($level)
    {
        if ($level == null) {
            return 'All';
        } else if ($level >= 1 && $level <= 6) {
            return 'primary school : ' . $level;
        } else if ($level >= 7 && $level <= 9) {
            return 'college : ' . $level;
        } else {
            return 'high school : ' . ($level - 9);
        }


    }

    public function getLabel(){
        return $this->type  . ' (' . self::getLevelLabel($this->level) . ')';
    }
}
