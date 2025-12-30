<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceHp extends Model
{
    use HasFactory;

    protected $fillable = [
        'services_code',
        'date',
        'hp_id',
        'cost',
        'notes',
        'user_id',
    ];

    public function users() : BelongsTo {
        return $this->belongsTo(User::class, "user_id");
    }

    public function hps() : BelongsTo {
        return $this->belongsTo(Hp::class, 'hp_id');
    }

    public function cashFlow() : HasMany {
        return $this->hasMany(CashFlow::class, 'service_id');
    }

}
