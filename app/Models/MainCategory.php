<?php

namespace App\models;
use App\Observers\maincatObserver;
use Illuminate\Database\Eloquent\Model;
use App\models\subcategory;
class MainCategory extends Model
{
        protected $table = 'main_categories';
   	    protected $fillable = ['translation_lang', 'translation_of', 'name', 'slug', 'photo','active','created_at', 'updated_at'];

		   // observes //
		protected static function boot(){
			parent::boot();
			MainCategory::observe(maincatObserver::class);
		}

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
			return $val !== null ? asset('assets/'.$val) : "";
		}
	
		public function scopeDefaultcategory($query){
			return $query->where('translation_of', 0);
		}

		// Relation Ship
		
		// Self Relation
		public function categories(){
			return $this->hasMany(self::class, 'translation_of');
		}
		///
		
		public function vendors(){
			return $this->hasMany('App\models\vendor', 'category_id', 'id');
		}
	
		public function subcategories(){
			return $this->hasMany(subcategory::class, 'category_id', 'id');
		}
	
	
	}////
