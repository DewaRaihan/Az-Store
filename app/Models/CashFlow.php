<?php

namespace App\Models;

use Cache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CashFlow extends Model
{
        use HasFactory;

    protected $fillable = [
        'transaction_id',
        'service_id',
        'oprasional_id',
        'type_trans',
        'category',
        'amount',
        'profit',
        'created_at'
    ];

    public function transactions() : BelongsTo {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
    public function serviceHps() : BelongsTo {
        return $this->belongsTo(ServiceHp::class, 'service_id');
    }
    public function oprasionals() : BelongsTo {
        return $this->belongsTo(Oprasional::class, 'oprasional_id');
    }

    protected static function booted()
    {
        static::created(fn() => self::clearStatsCache());
        static::updated(fn() => self::clearStatsCache());
        static::deleted(fn() => self::clearStatsCache());
    }

    public static function clearStatsCache()
    {
        Cache::forget('monthlyNetProfit_stats');
        Cache::forget('monthlyIncome_stats');
        Cache::forget('monthlySpending_stats');
        Cache::forget('monthlyMargin_stats');
    }

}
