<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vouchers';
    public $primaryKey = 'id';
    protected $dates = ['deleted_at'];
}
