<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Demand
 * @package App\Models
 *
 * @property int user_id
 * @property int article_id
 * @property string motive
 * @property string status
 */
class Demand extends Model
{
    use HasFactory;

    const STATUS_PENDING = 'pending';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_REFUSED = 'refused';

    public function getStatus(){

    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function article(): BelongsTo{
        return $this->belongsTo((Article::class));
    }

}
