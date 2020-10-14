<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Vendor extends Model
{
    use Notifiable;
    
    protected $table = 'vendors';
    protected $fillable = ['name', 'logo', 'mobile', 'address', 'email', 'active', 'category_id', 'created_at',
    'updated_at'   
    ];
    protected $hidden = ['category_id'];

    //scopes
    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function getLogoAttribute($val){
        return $val !== null ? asset('assets/' . $val) : "";
    }

    public function scopeSelection($query){
        return $query->select('id', 'active' , 'category_id', 'name', 'logo', 'mobile');
    }

    public function getactive(){
        return $this->active == 1 ? 'مفعل' : 'غير مفعل';
    }
    
    // Relation Ship //
    
    public function category(){
    return $this->belongsTo('App\models\MainCategory', 'category_id', 'id');
    }

}///