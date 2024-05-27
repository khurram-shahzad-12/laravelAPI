<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\userController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route ::get('product',function(Request $request){
    return response()->json([
        'name'=>'plastic_bottle',
    ]);
});

Route::get('/username',[userController::class,"username"]);

Route::get('/products',[ProductController::class,'createproduct']);
Route::post('/products',[ProductController::class,'postproducts']);
Route::delete('/deleteproduct',[ProductController::class,'deleteproduct']);
Route::get('/getsingleproduct',[ProductController::class,'getsingleproduct']);
Route::put('/updateproduct',[ProductController::class,'updateproduct']);