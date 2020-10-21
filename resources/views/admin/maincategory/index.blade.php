@extends('layouts.admin')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> الاقسام الرئيسيه </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">جميع اقسام الموقع </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                </div>

                                 @include('admin.includes.alert.success')
                                @include('admin.includes.alert.error') 

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <table
                                            class="table display nowrap table-striped table-bordered scroll-horizontal">
                                            <thead>
                                            <tr>
                                                <th>القسم</th>
                                                <th>اللغه</th>
                                                <th>الحالة</th>
                                                <th>صورة القسم</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                                @isset($MainCategory)
                                                 @foreach($MainCategory as $MainCategorys)
                                                    <tr>
                                                    <td>{{$MainCategorys->name}}</td>
                                                        <td>{{get_default_lang()}}</td>
                                                        <td>{{$MainCategorys->getActive()}}</td>
                                                        <td><img style="width: 100px;height: 100px" src="{{$MainCategorys->photo}}"></td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{route('admin.edit.main_cat', $MainCategorys->id)}}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>


                                                                <a href="{{route('admin.delete.main_cat', $MainCategorys->id)}}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>

                                                                <a href="{{route('admin.change_status.main_cat', $MainCategorys->id)}}"
                                                                   class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                                                @if($MainCategorys->active == 1) الغاء التغعيل
                                                                @else
                                                                تفعيل
                                                                @endif
                                                                </a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                  @endforeach
                                                 @endisset   
                                             


                                            </tbody>
                                        </table>
                                        <div class="justify-content-center d-flex">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@stop