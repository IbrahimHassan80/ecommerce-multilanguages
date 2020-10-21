<?php
use Illuminate\Support\Facades\Config;

// just get active language //
function get_languages(){
	return \App\Models\language::active()->selection()->get();
}


function get_default_lang(){
	return config::get('app.locale');
}

 
 function uploadimage($folder, $image){
	$image->store('/', $folder);
	$filename = $image->hashName();
	$path = 'images/' . $folder . '/' . $filename;
	return $path;
}