<?php

use App\User;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('users', function (Request $request) {
    return User::with('photo')->latest()->orderBy('created_at', 'desc')->get();
});
Route::post('/destroy', function (Request $request) {
    if ($request->id) {
        foreach ($request->id as $id) {
            User::destroy($id);
        }
    }
})->name('destroy');