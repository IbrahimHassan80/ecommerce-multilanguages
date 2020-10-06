<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\MainCategory;
use App\Http\Requests\main_cat_request;
use DB;
class maincategorycontroller extends Controller

{
    public function index(){
    	$defaultlang = get_default_lang();
    	$MainCategory = MainCategory::where('translation_lang', $defaultlang)->selection()->get();
    	
    	return view('admin.maincategory.index', compact('MainCategory'));
    }

	
	public function create(){
		return view('admin.maincategory.create');
	}

	
	public function store(main_cat_request $request){
		//
		try{
			
		$main_category = collect($request->category);
			
		$filter = $main_category->filter(function($value, $key){
			
			return $value['abbr'] == get_default_lang();
		});
		
		$default_category = array_values($filter->all())[0]; // final //
		
		$filepath = "";
		if($request->has('photo')){
		  $filepath = uploadimage('maincategory', $request->photo);
		}
		  DB::beginTransaction();
		  $default_category_id = MainCategory::insertGetId([
				'translation_lang' => $default_category['abbr'],
				'translation_of' => 0,
				'name' => $default_category['name'],
				'slug' => $default_category['name'],
				'photo' => $filepath,
		]);
		
		 $categories = $main_category->filter(function($value, $key){	
			return $value['abbr'] !== get_default_lang();
		});
	
		if(isset($categories) && $categories->count() > 0){
			$category_arr=[];
			foreach($categories as $category){
				$category_arr[]=[
				'translation_lang' => $category['abbr'],
				'translation_of' => $default_category_id,
				'name' => $category['name'],
				'slug' => $category['name'],
				'photo' => $filepath
				];
			}
			MainCategory::insert($category_arr);
		}
		
		DB::commit();
		return redirect()->route('admin.main_cat')->with(['success' => 'تم الحفظ بنجاح']);
	
	} catch(\Exception $ex){
		
		DB::rollback();
		return redirect()->route('admin.main_cat')->with(['notsuc' => 'يوجد مشكله الرجاء المحاوله لاحقا']);

	}
}
	public function edit($category_id){
		 $category = MainCategory::with('categories')->Selection()->find($category_id);
		if(!$category)
		return redirect()->route('admin.main_cat')->with(['notsuc' => 'هذا القسم غير موجود']);
		
		return view('admin.maincategory.edit', compact('category'));
	}

	public function update(main_cat_request $request, $main_cat){
		try{
		$maincategory = MainCategory::find($main_cat);
		
		if(!$maincategory)
		 return redirect()->route('admin.main_cat')->with(['notsuc' => 'هذا القسم غير موجود']);
		 /// 
		 $category = array_values($request -> category)[0];
		 if(!$request->has('category.0.active'))
		  $request->request->add(['active' => 0]);
		else
		  $request->request->add(['active' => 1]);
			 
		  MainCategory::where('id',$main_cat)->update([
			   'name' => $category['name'],
				'active' => $request->active,
			   ]);
			   
			   // photo //
			   if($request->has('photo')){
				$path = uploadimage('maincategory', $request->photo);
				MainCategory::where('id',$main_cat)->update([
					 'photo' => $path
				]);}
		
		return redirect()->route('admin.main_cat')->with(['success' => 'تم التحديث بنجاح']);
		  
	} catch(\Exception $ex){
		
		return redirect()->route('admin.main_cat')->with(['notsuc' => 'يوجد مشكله الرجاء المحاوله لاحقا']);
		  }
	}

}//end class