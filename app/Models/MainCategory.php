<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
        protected $table = 'main_categories';
   	    protected $fillable = ['translation_lang', 'translation_of', 'name', 'slug', 'photo','active','created_at', 'updated_at'];


   	    // SCOPES //
   	    public function scopeActive($query){
   	    	return $query->where('active', 1);
   	    }
		   public function getactive(){
			return $this->active == 1 ? 'مفعل' : 'غير مفعل ';
		}

		public function scopeSelection($query){
			return $query->select('id','translation_lang','translation_of','name','slug','photo','active');
		}
	
		public function getPhotoAttribute($val){
			return ($val !== null) ? asset('assets/'.$val) : "";
		}
	

		// Self Relation
		public function categories(){
			return $this->hasMany(self::class, 'translation_of');
		}

	}