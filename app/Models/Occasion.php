<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Occasion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    protected $table = 'occasions';

    public $primaryKey = 'id';

    protected $dates = ['deleted_at'];
}
