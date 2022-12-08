<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use BeyondCode\Vouchers\Traits\HasVouchers;

class Package extends Model
{
    use HasFactory, SoftDeletes, HasVouchers;

    protected $fillable = [
        'user_id',
        'name',
        'pax',
        'price',
        'inclusion',
        'occasion_id',
        'discount',
        'cost_price'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
