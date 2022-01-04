<?php

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

Route::get('/', function () {
    return view('welcome');
    
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/subscribers', function () {
   
    $details = [
        'title' => 'Mail from logisticli15',
        'body' => 'This is for testing email using smtp'
    ];
   
    \Mail::to('vaibhavviradiya123.vv@gmail.com')->send(new \App\Mail\Subscribe($details));
   
    dd("Email is Sent.");
});
