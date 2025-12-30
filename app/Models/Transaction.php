<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Transaction extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "transaction_code",
        "date",
        "type_trans",
        'hp_in',
        "hp_out",
        'related_transaction_id',
        "extra_fee",
        "purchase_price",
        "selling_price",
        "profit",
        "notes",
        'user_id',
        'customer_id',
        'created_at'
    ];

    public function images(): MorphMany{
        return $this->morphMany(Image::class, "imageable");
    }
    // ubah HpIn
    public function hpIn(): BelongsTo{
        return $this->belongsTo(Hp::class, "hp_in", 'id');
    }
    public function hpOut(): BelongsTo{
        return $this->belongsTo(Hp::class, "hp_out", 'id');
    }

    public function users(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }
    public function customers(): BelongsTo{
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function cashFlow() : HasMany {
        return $this->hasMany(CashFlow::class, 'transaction_id');
    }

    public function related()
    {
        return $this->belongsTo(Transaction::class, 'related_transaction_id');
    }
        // Relationship with detail
    public function detail(): BelongsTo
    {
        return $this->belongsTo(Detail::class);
    }

    // Relationship with transaction where this HP is hp_in (purchase)
    public function purchaseTransaction(): HasOne
    {
        return $this->hasOne(Transaction::class, 'hp_in')->where('type_trans', 'purchase');
    }

    // Relationship with transaction where this HP is hp_out (selling)
    public function sellingTransaction(): HasOne
    {
        return $this->hasOne(Transaction::class, 'hp_out')->where('type_trans', 'selling');
    }

    // All transactions involving this HP
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'hp_in')
            ->orWhere('hp_out', $this->id);
    }
    
    // Accessor untuk mendapatkan harga beli
    public function getPurchasePriceAttribute()
    {
        return $this->purchaseTransaction ? $this->purchaseTransaction->purchase_price : 0;
    }

}
