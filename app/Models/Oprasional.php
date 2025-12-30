<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Oprasional extends Model
{
    use HasFactory;

    protected $fillable = [
        'oprasional_code',
        'name',
        'cost',
        'qty',
        'notes',
        'user_id',
    ];

    public function users() : BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cashFlow() : HasMany {
        return $this->hasMany(CashFlow::class, 'oprasional_id');
    }
}
