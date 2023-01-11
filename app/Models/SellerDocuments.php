<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SellerDocuments extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'file',
        'mime_type'
    ];

    protected $table = 'seller_documents';
    public $primaryKey = 'id';
    protected $dates = ['deleted_at'];
}
