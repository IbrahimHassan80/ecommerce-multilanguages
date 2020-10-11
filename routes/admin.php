<?php 

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for Admin Page. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
define('paginate_count',10);

//--login--//
Route::group(['namespace'=>'admin','middleware' => 'guest:admin'], function(){

	Route::get('admin-login', 'logincontroller@getlogin')->name('get.admin.login');
	Route::post('admin-check', 'logincontroller@checklogin')->name('admin.login');

});//-end login-//

/// dashboard //
Route::group(['middleware'=> 'auth:admin', 'namespace'=>'admin'], function(){
	Route::get('/', 'dashboardcontroller@dashboard')->name('admin.dashboard');

	//lang group //
	Route::group(['prefix'=>'language'],function(){
		Route::get('/', 'languagecontroller@index')->name('admin.language');
		Route::get('create', 'languagecontroller@create')->name('admin.language.create');
		Route::post('store', 'languagecontroller@store')->name('admin.language.store');
		
		Route::get('edit/{id}', 'languagecontroller@edit')->name('admin.edit.language');
		Route::post('update/{id}', 'languagecontroller@update')->name('admin.update.language');
		
		Route::get('delete/{id}', 'languagecontroller@destroy')->name('admin.delete.language');
	});
	// END lang //
	
	// main categories Group //
  Route::group(['prefix'=>'main_category'],function(){
	Route::get('/', 'maincategorycontroller@index')->name('admin.main_cat');
	Route::get('create', 'maincategorycontroller@create')->name('admin.main_cat.create');
	Route::post('store', 'maincategorycontroller@store')->name('maincat.store');	
	Route::get('edit/{id}', 'maincategorycontroller@edit')->name('admin.edit.main_cat');
	Route::post('update/{id}', 'maincategorycontroller@update')->name('admin.update.main_cat');
	Route::get('delete/{id}', 'maincategorycontroller@destroy')->name('admin.delete.main_cat');
		
	});	

	// begin Vendor Group //
	Route::group(['prefix'=>'vendors'],function(){
		Route::get('/', 'vendorscontroller@index')->name('admin.vendors');
		Route::get('create', 'vendorscontroller@create')->name('admin.vendors.create');
		Route::post('store', 'vendorscontroller@store')->name('admin.vendors.store');	
		Route::get('edit/{id}', 'vendorscontroller@edit')->name('admin.edit.vendors');
		Route::post('update/{id}', 'vendorscontroller@update')->name('admin.update.vendors');
		Route::get('delete/{id}', 'vendorscontroller@destroy')->name('admin.delete.vendors');
			
		});	

});
