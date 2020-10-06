<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    protected $table = 'admins';
    protected $fillable = ['name', 'email', 'password', 'photo', 'created_at', 'updated_at'];
    
}
