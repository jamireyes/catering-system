<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory, SoftDeletes;

    // protected $fillable = [
    //     'order_id',
    // ];

    protected $table = 'favorites';
    public $primaryKey = 'id';
    protected $dates = ['deleted_at'];
}
