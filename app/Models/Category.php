<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'user_id'
    ];

    protected $table = 'categories';
    public $primaryKey = 'id';
    protected $dates = ['deleted_at'];

    public function item()
    {
        return $this->hasOne(Item::class);
    }

}
