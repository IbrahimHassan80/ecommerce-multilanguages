<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\language;
use App\Http\Requests\lang_request;

class languagecontroller extends Controller
{
    
    public function index(){
    	$language = language::Selection()->paginate(paginate_count);
    	return view('admin.languages.index', compact('language'));
    }

    
    public function create(){
    	return view('admin.languages.create');
    }
    
    
    
    public function store(lang_request $request){
    	//validate in request file

    	try{
    	language::create($request->except(['_token']));
    	return redirect()->route('admin.language')->with(['success'=> 'تم حفظ اللغه بنجاح']);
    	
    	} catch (\Exception $ex){
		return redirect()->route('admin.language')->with(['notsuc'=> 'يوجد مشكله برجاء المحاوله لاحقا']);
    	}
	}
	

    public function edit($id){
		
		$language = language::selection()->find($id);
    	if(!$language){
    		return redirect()->route('admin.language');}
    		
    	return view('admin.languages.edit', compact('language'));
    }

	
	public function update(lang_request $request, $id){
		
		try{
		$language = language::find($id);
		
		if(!$language){
			return redirect()->route('edit.language')->with(['notsuc'=>'يوجد مشكله فى تحديث اللغه']);
		}
		if(!$request->has('active'))
			$request->request->add(['active' => 0]);

		$language->update($request -> except('_token'));
			return redirect()->route('admin.language')->with(['success'=>'تم تحديث الللغه بنجاح']);
	
		} catch (\Exception $ex) {
		return redirect()->route('edit.language')->with(['notsuc'=>'الرجاء المحاوله فيما بعد']);	
		 }	
	  } 

	public function destroy($id){
	
	try{
		$language = language::find($id);
		
		if(!$language)
			return redirect()->route('admin.language')->with(['notsuc'=>'هذه اللغه غير موجوده']);
		
		$language->delete();
			return redirect()->route('admin.language')->with(['notsuc'=>'تم حذف اللغه بنجاح']);
	
	} 
	catch(\Exception $ex){
			return redirect()->route('admin.language')->with(['notsuc'=>'توجد مشكله الرجاء المحاوله فيما بعد']);
	}
		
		}

}//
