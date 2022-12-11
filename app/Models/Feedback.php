<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'comment',
        'rating'
    ];

    protected $table = 'feedback';
    public $primaryKey = 'id';
    protected $dates = ['deleted_at'];
}
