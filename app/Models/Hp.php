<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Hp extends Model
{
    use HasFactory;

    protected $fillable = [
        "code_hp",
        'date',
        "type_hp",
        'grade',
        'status',
        "price_in_catalog",
        "notes",
        "detail_id",
        "created_at",
        "updated_at"
    ];

    public function detail(): BelongsTo{
        return $this->belongsTo(Detail::class, 'detail_id');
    }

    public function images(): MorphMany{
        return $this->morphMany(Image::class, "imageable");
    }

    public function transactionIn(): HasMany{
        return $this->hasMany(Transaction::class, "hp_in", 'id');
    }
    public function transactionOut(): HasMany{
        return $this->hasMany(Transaction::class, "hp_out", 'id');
    }

    public function serviceHp() : HasOne {
        return $this->hasOne(ServiceHp::class, 'hp_id');
    }
    public function purchaseTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'hp_in', 'id')
            ->where('type_trans', 'purchase');
    }

    public function sellingTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'hp_out', 'id')
            ->where('type_trans', 'selling');
    }

}
