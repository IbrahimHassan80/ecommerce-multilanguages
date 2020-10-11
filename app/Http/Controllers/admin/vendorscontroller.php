<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\MainCategory;
use App\Http\Requests\vendor_request;
class vendorscontroller extends Controller
{
    public function index(){
        $vendors = vendor::selection()->paginate(paginate_count);
        return view('admin.vendor.index', compact('vendors'));
    }

    public function create(){
        $default_lang = get_default_lang();
        $categories = MainCategory::where('translation_of', 0)->active()->get();
        return view('admin.vendor.create', compact('categories'));
    }

    public function store(vendor_request $request){
    try{           
        if(!$request->has('active'))
            $request->request->add([ 'active' => 0 ]);
        
        $filepath = "";
        if($request->has('logo'))
            $filepath = uploadimage('vendors', $request->logo);
        
            Vendor::create([
                'name' => $request->name,
                'email' =>$request->email,
                'mobile' => $request->mobile,
                'category_id' => $request->category_id,
                'address' => $request->address,
                'active' => $request->active,
                'logo' => $filepath
            ]);
            return redirect()->route('admin.vendors')->with(['success' => 'تم الحفظ بنجاح']);
        }catch(\Exception $ex){
            return redirect()->route('admin.vendors')->with(['notsuc' => 'يوجد مشكله الرجاء المحاوله لاحقا']);
        }

 }
}