<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StripeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", [PagesController::class, 'index']);
//Route::get("/about", [PagesController::class, 'about']);
Route::post("/about", [PagesController::class, 'about'])-> name('item');
Route::get("/services", [PagesController::class, 'services']);
Route::post("/services", [PagesController::class, 'services'])-> name('services');
Route::get("resultpages/success", [PagesController::class, 'succsess']);
Route::get("resultpages/fail", [PagesController::class, 'fail']);

Route::get('stripe', [StripeController::class, 'stripe']);
Route::post('stripe', [StripeController::class, 'stripePost'])-> name('stripe.post');
Route::post('posts', [PostController::class, 'test'])-> name('test');
Route::get ( '/stripe', function () {
    return view ( 'stripe' );
} );
Route::post ( '/', [StripeController::class,'call'] );


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('posts', '\App\Http\Controllers\PostsController');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
