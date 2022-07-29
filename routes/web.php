<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentController;
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

Route::post('del_user', [App\Http\Controllers\HomeController::class, 'delete']);

// Route::post('create_user',[App\Http\Controllers\HomeController::class, 'store']);

// Route::post('edit_user',[App\Http\Controllers\HomeController::class, 'update']);

Route::get('/form',function() {
    return view('form');
 });

//  Route::resource('/home', CrudController::class);

 Route::get('/create',[App\Http\Controllers\HomeController::class, 'create']);

 Route::post('insert_user',[App\Http\Controllers\HomeController::class, 'store'])->name('insert_user');


 Route::get('edit/{id}',[App\Http\Controllers\HomeController::class, 'edit']);

 Route::post('edit_user',[App\Http\Controllers\HomeController::class, 'update'])->name('edit_user');

 Route::get('google_pay', [PaymentController::class, 'index'])->name('gpay');

 Route::post('create-payment-intent', [PaymentController::class, 'createPaymentIntent']);









// Route::get('/subscribers', function () {
   
//     $details = [
//         'title' => 'Mail from logisticli15',
//         'body' => 'This is for testing email using smtp'
//     ];
   
//     Mail::to($user->email)->send(new \App\Mail\Subscribe($details));
   
//     dd("Email is Sent.");
// });
