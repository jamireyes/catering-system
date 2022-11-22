<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'pax',
        'price',
        'inclusion',
        'occasion_id',
        'discount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
