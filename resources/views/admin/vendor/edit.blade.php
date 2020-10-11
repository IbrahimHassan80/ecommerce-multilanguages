@extends('layouts.admin')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">الرئيسية </a>
                            </li>
                            <li class="breadcrumb-item"><a href="">تعديل الاقسام الرئيسيه</a>
                            </li>
                        <li class="breadcrumb-item active">تعديل قسم {{$category->name}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form"> تعديل قسم رئيسي </h4>
                                <a class="heading-elements-toggle"><i
                                        class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            @include('admin.includes.alert.success')
                            @include('admin.includes.alert.error')
                            <div class="card-content collapse show">
                                <div class="card-body">
                                <form class="form" action="{{route('admin.update.main_cat',$category->id)}}" method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$category->id}}">
                                        {{-- show old photo --}}
                                        <div class="form-group">
                                            <div class="text-center">
                                                <img src="{{$category->photo}}" class="rounded-circle height-150 width-150">
                                            </div>
                                        </div>
                                        {{-- end show --}}
                                        
                                        <div class="form-group">
                                            <label> صوره القسم </label>
                                            <label id="projectinput7" class="file center-block">
                                                <input type="file" id="file" name="photo">
                                                @error('photo')
                                                 <span class="text-danger">{{$message}} </span>
                                                @enderror
                                                <span class="file-custom"></span>
                                            </label>
                                             <span class="text-danger"> </span>
                                         </div>

                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-home"></i> بيانات  القسم </h4>
                                            

                                                
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1">اسم القسم {{__('messages.' . $category->translation_lang)}}</label>
                                                    <input type="text" value="{{$category->name}}" id="name"
                                                               class="form-control"
                                                               placeholder="مثال ملابس"
                                                               name="category[0][name]">
                                                               @error("category.0.name")
                                                               <span class="text-danger">{{$message}} </span>
                                                              @enderror
                                                     </div>
                                                </div>

                                                <div class="col-md-6 hidden">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> الاختصار  {{__('messages.' . $category->translation_lang)}}</label>
                                                    <input type="text" value="{{$category->translation_lang}}" id="name"
                                                               class="form-control"
                                                               placeholder="مثال ar"
                                                               name="category[0][abbr]">
                                                               @error("category.0.abbr")
                                                               <span class="text-danger">هذا الحقل مطلوب</span>
                                                              @enderror
                                                     </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mt-1">
                                                        <input type="checkbox"  value="1" name="category[0][active]"
                                                               id="switcheryColor4"
                                                               class="switchery" data-color="success"
                                                                @if($category->active == 1) checked @endif/>
                                                        <label for="switcheryColor4"
                                                               class="card-title ml-1">الحالة {{__('messages.' . $category->translation_lang)}}</label>

                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1"
                                                    onclick="history.back();">
                                                <i class="ft-x"></i> تراجع
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> حفظ
                                            </button>
                                        </div>
                                    </form>
                                    
                                    {{--  Other Languages  --}}
                                    <ul class="nav nav-tabs">                                            
                                        @isset($category->categories)
                                        @foreach($category->categories as $index => $langs) 
                                        <li class="nav-item">
                                            <a class="nav-link @if($index == 0) active @endif" id="homeLable-tab"  data-toggle="tab"
                                        href="#homeLable{{$index}}" aria-controls="homeLable"
                                        aria-expanded="{{$index == 0 ? 'true' : 'false'}}">{{$langs->translation_lang}}</a>
                                        </li>
                                        @endforeach
                                        @endisset
                                      </ul>
                                
                                      <div class="tab-content px-1 pt-1">
                                        @isset($category->categories)
                                        @foreach($category->categories as $index => $langs) 
                                        <div role="tabpanel" class="tab-pane @if($index == 0) active @endif" id="homeLable{{$index}}"
                                        aria-labelledby="homeLable-tab"
                                        aria-expanded="true">
                                        <form class="form" action="{{route('admin.update.main_cat',$langs->id)}}" method="post"
                                            enctype="multipart/form-data">
                                          @csrf
                                          <input type="hidden" name="id" value="{{$langs->id}}">
                                          
                                          <div class="form-group">
                                              <label> صوره القسم </label>
                                              <label id="projectinput7" class="file center-block">
                                                  <input type="file" id="file" name="photo">
                                                  @error('photo')
                                                   <span class="text-danger">{{$message}} </span>
                                                  @enderror
                                                  <span class="file-custom"></span>
                                              </label>
                                               <span class="text-danger"> </span>
                                           </div>
  
                                          <div class="form-body">
                                              <h4 class="form-section"><i class="ft-home"></i> بيانات  القسم </h4>
                                              
  
                                                  
                                              <div class="row">
                                                  <div class="col-md-12">
                                                      <div class="form-group">
                                                          <label for="projectinput1">اسم القسم {{__('messages.' . $langs->translation_lang)}}</label>
                                                      <input type="text" value="{{$langs->name}}" id="name"
                                                                 class="form-control"
                                                                 placeholder="مثال ملابس"
                                                                 name="category[0][name]">
                                                                 @error("category.0.name")
                                                                 <span class="text-danger">{{$message}} </span>
                                                                @enderror
                                                       </div>
                                                  </div>
  
                                                  <div class="col-md-6 hidden">
                                                      <div class="form-group">
                                                          <label for="projectinput1"> الاختصار  {{__('messages.' . $langs->translation_lang)}}</label>
                                                      <input type="text" value="{{$langs->translation_lang}}" id="name"
                                                                 class="form-control"
                                                                 placeholder="مثال ar"
                                                                 name="category[0][abbr]">
                                                                 @error("category.0.abbr")
                                                                 <span class="text-danger">هذا الحقل مطلوب</span>
                                                                @enderror
                                                       </div>
                                                  </div>
                                              </div>
  
  
                                              <div class="row">
                                                  <div class="col-md-6">
                                                      <div class="form-group mt-1">
                                                          <input type="checkbox"  value="1" name="category[0][active]"
                                                                 id="switcheryColor4"
                                                                 class="switchery" data-color="success"
                                                                  @if($langs->active == 1) checked @endif/>
                                                          <label for="switcheryColor4"
                                                                 class="card-title ml-1">الحالة {{__('messages.' . $langs->translation_lang)}}</label>
  
                                                          <span class="text-danger"></span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
  
  
                                          <div class="form-actions">
                                              <button type="button" class="btn btn-warning mr-1"
                                                      onclick="history.back();">
                                                  <i class="ft-x"></i> تراجع
                                              </button>
                                              <button type="submit" class="btn btn-primary">
                                                  <i class="la la-check-square-o"></i> حفظ
                                              </button>
                                          </div>
                                      </form>
                                    </div>
                                @endforeach
                                @endisset
                                 </div>
                                
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
</div>
    @stop