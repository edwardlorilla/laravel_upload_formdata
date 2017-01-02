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


use App\Photo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

Route::get('/', function () {
    return view('welcome');
});

Route::post('submit', function (Request $request) {
    $input = $request->all();
    if (trim($request->password) == '') {
        $input = $request->except('password');
    } else {
        $input = $request->all();
    }
    if ($file = $request->file('image')) {
        $name = time() . $file->getClientOriginalName();
        $file->move('images', $name);
        $photo = Photo::create(['file' => $name]);
        $input['photo_id'] = $photo->id;
    }
    $input['password'] = bcrypt($request->password);
    User::create($input);
    return response()->json(['success' => true, 'message' => 'images uploaded']);


})->name('submit');

Route::resource('users', 'UsersController');