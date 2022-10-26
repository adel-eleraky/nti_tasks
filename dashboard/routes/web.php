<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::controller(ProductController::class)->prefix('dashboard')->name('dashboard.')->group(function(){

    Route::prefix('products')->name('products.')->controller(ProductController::class)->group(function(){
        Route::get('/' ,  'get')->name('get');
        Route::get('/edit/{id}' ,  'edit' )->name('edit');
        Route::delete('/delete/{id}' ,'delete' )->name('delete');
        Route::put('/update/{id}' ,  'update' )->name('update');
        Route::get('/create' , 'create' )->name('create');
        Route::post('/store' ,  'store' )->name('store');
    });
});

require __DIR__.'/auth.php';