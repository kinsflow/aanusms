<?php

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

use App\Http\Controllers\ResultController;
use App\Result;
use App\User;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function(){
    return view('dashboard');
});

Route::get('/adminView', function(){
    return view('adminlogin');
})->name('adminView');


Route::post('/registerAdmin', function(){
    $register = User::create([
        'first_name' => request('first_name'),
        'last_name' => request('last_name'),
        'matric_no' => 'admin',
        'number' => 'admin',
        'role_id' => 1,
        'email' => request('email'),
        'password' => Hash::make(request('password')),
    ]);

    if($register){
        return redirect()->route('login');
    }
})->name('registerAdmin');




Route::resource('/result', 'ResultController');

Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
