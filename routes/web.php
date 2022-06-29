<?php

use App\Http\Controllers\InformationController;
use App\Http\Controllers\UserController;
use App\Models\Information;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(UserController::class)->group(function () {
    Route::get('user/register','register');
    Route::post('user/register','store')->name("register");
    Route::get('user/login','login');
    Route::post('user/login','check')->name('login');
    Route::post('/user/logout', 'logout')->middleware('user')->name("logout");

});

Route::middleware('user')->group(function () {

    Route::controller(InformationController::class)->group(function () {
        Route::delete('information/delete/{id}', 'destory')->name('info.delete');
        Route::get('information/edit/{id}', 'edit')->name('info.edit');
        Route::put('information/update/{id}', 'update')->name('info.update');
        Route::get('information/show/{information}', 'show')->name('info.show');
        Route::post('information/store', 'store')->name('info.store');
    });

    Route::get('/', function () {
        $datas = Information::where('user_id', '=', session('LoggedUser'))->paginate(5);
        return view('home', compact('datas'));
    })->name('home');
});
