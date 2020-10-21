<?php

namespace App\models;
use App\models\MainCategory;
use Illuminate\Database\Eloquent\Model;

class subcategory extends Model
{
    protected $table = 'sub_categories';
    protected $fillable = ['name','parent_id', 'category_id','slug', 'photo','active','translation_lang', 'translation_of','created_at', 'updated_at'];

    // scopes //

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function getactive($query){
        return $this->active == 1 ? 'مفعل' : 'غير مفعل';
    }

    public function scopeSelection($query){
        return $query->select('id','parent_id','translation_lang','translation_of','name','slug','photo','active');
    }

    public function getPhotoAttribute($val){
        return $val !== null ? asset('assets/'.$val) : "";
    }

    // get MainCategory of subMainCategory //
    public function MainCategory(){
        return $this->belongsTo(MainCategory::class, 'category_id', 'id');
    }

}
