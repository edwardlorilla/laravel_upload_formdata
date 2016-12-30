<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

Route::get('/', function () {
    return view('welcome');
});

Route::post('submit', function (Request $request) {
    foreach ( $request-> file('image') as $image) {
        $imagename = time() . $image->getClientOriginalName();
        $uploadFile = $image->move('public/uploads', $imagename);
        if ($uploadFile) {
            $uploadedImage[] = $imagename;
        }
    }
    return response()->json(['success' => true, 'message' => 'images uploaded']);

})->name('submit');