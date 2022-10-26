<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\ProductController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(ProductController::class)->prefix('dashboard')->name('dashboard.')->group(function(){

    Route::prefix('products')->name('products.')->controller(ProductController::class)->group(function(){
        Route::get('/' ,  'get')->name('get');   //api/dashboard/products/
        Route::get('/edit/{id}' ,  'edit' )->name('edit');  //api/dashboard/products/edit/1
        Route::delete('/delete/{id}' ,'delete' )->name('delete');  //api/dashboard/products/delete/1
        Route::post('/update/{id}' ,  'update' )->name('update');  //api/dashboard/products/update/1
        Route::get('/create' , 'create' )->name('create');  //api/dashboard/products/create
        Route::post('/store' ,  'store' )->name('store');  //api/dashboard/products/store
    });
});