<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlySummary extends Model
{
    use HasFactory;

    protected $fillable = [
    'year',
    'month',
    'total_purchase',
    'total_selling',
    'total_service',
    'total_oprasional',
    'total_profit',
];

}
