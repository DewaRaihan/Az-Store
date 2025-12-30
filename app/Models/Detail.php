<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand',
        'storage',
        'color',
        'imei',
        'serial_number',
        'network',
        'warranty',
        'display',
        'body',
        'battery',
        'battery_health',
        'face_id',
        'true_tone',
        'finger_print',
        'front_camera',
        'rear_camera',
        'other',
    ];


    public function hp(): HasMany{
        return $this->hasMany(Hp::class, 'detail_id');
    }
}
