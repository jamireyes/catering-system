<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use DB;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'address_1',
        'address_2',
        'city',
        'state',
        'zipcode',
        'phone_number',
        'image'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['full_address'];

    public function package()
    {
        return $this->hasMany(Package::class);
    }

    public function category()
    {
        return $this->hasMany(Category::class);
    }

    public function item()
    {
        return $this->hasMany(Item::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public static function getEnumValues($column)
    {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM users WHERE Field = '{$column}'"))[0]->Type ;
        
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        
        foreach( explode(',', $matches[1]) as $value ) {
            $v = trim( $value, "'" );
            $enum = \Arr::get($enum, $v, $v);
        }
        
        return $enum;
    }

    public function getFullAddressAttribute() 
    {
        return $this->address_1.' '.$this->address_2.' '.$this->city.' '.$this->state.' '.$this->zipcode;
    }
}
