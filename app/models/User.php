<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name','email','password','remember_token','created_at','updated_at'
    ];
}
