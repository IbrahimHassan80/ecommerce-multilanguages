<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\MainCategory;
use App\Http\Requests\vendor_request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\vendorcreated;
use DB;
use Illuminate\Support\Str;

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
        
            $vendor = Vendor::create([
                'name' => $request->name,
                'email' =>$request->email,
                'mobile' => $request->mobile,
                'category_id' => $request->category_id,
                'address' => $request->address,
                'active' => $request->active,
                'password' => $request->password,
                'logo' => $filepath,
            ]);
        
       Notification::send($vendor, new vendorcreated($vendor));
       return redirect()->route('admin.vendors')->with(['success' => 'تم الحفظ بنجاح']);
        
        
        }catch(\Exception $ex){
            return $ex;
            return redirect()->route('admin.vendors')->with(['notsuc' => 'يوجد مشكله الرجاء المحاوله لاحقا']);
        } 
    }

            public function edit($id){
                $vendor = vendor::selection()->find($id);
                $dafault_lang = get_default_lang();
                $maincategory = MainCategory::where('translation_lang', 0)->active()->get();
                if(!$vendor)
             return redirect()->route('admin.vendors')->with(['notsuc' => 'هذا القسم غير موجود']);

                return view('admin.vendor.edit', compact('vendor', 'maincategory'));
             
            }

            public function update(vendor_request $request, $id){
             
                try{
                $vendor = vendor::find($id);
                if(!$vendor)
                     return redirect()->route('admin.vendors')->with(['notsuc' => 'هذا القسم غير موجود']);
                
                     if(!$request->has('active'))
                    $request->request->add(['active' => 0]);  
                
                DB::begintransaction();
                
                if($request->has('logo')){
                $filepath = uploadimage('vendors', $request->logo);
                vendor::where('id',$id)->update([
                    'logo' => $filepath
                ]);
            }
           
            $data = $request->except('_token','id', 'logo', 'password');
            if($request->has('password')){
                $data['password'] = bcrypt($request->password);
            }
            
            vendor::where('id',$id)->update($data); 
            
            DB::commit();
            return redirect()->route('admin.vendors')->with(['success' => 'تم التحديث بنجاح']);

            
        }catch(\Exception $ex){
        return $ex;
         DB::rollback();
        return redirect()->route('admin.vendors')->with(['notsuc' => 'يوجد مشكله الرجاء المحاوله لاحقاا']);
        }
      }

        
        public function change_status($id){
            $vendor = vendor::find($id);
            if(!$vendor)
                 return redirect()->route('admin.vendors')->with(['notsuc' => 'هذا القسم غير موجود']);
            $status = $vendor->active == 0 ? 1 : 0;
            $vendor->update(['active' => $status]);
		        return redirect()->route('admin.vendors')->with(['success' => 'تم تغيير حالة القسم بنجاح']);

        }
        
        
        public function destroy($id){
           try{
            $vendor = vendor::find($id);
            if(!$vendor)
            return redirect()->route('admin.vendors')->with(['notsuc' => 'هذا القسم غير موجود']);
            
            $image = str::after($vendor->logo, 'assets');
            $image = base_path('assets' . $image);
            unlink($image);

            $vendor->delete();
            return redirect()->route('admin.vendors')->with(['success' => 'تم حذف المتجر بنجاح']);
           }catch(\Exception $ex){
             return redirect()->route('admin.vendors')->with(['notsuc' => 'يوجد مشكله الرجاء المحاوله لاحقاا']);
           }
        }
     }