<?php
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/products', [ProductController::class,'index']);
Route::get('/product', [ProductController::class,'ShowById']);
Route::post('/storage',[ProductController::class,'store']);
Route::get('/products/{nameProducts}', [ProductController::class,'search']);
Route::post('/delete',[ProductController::class,'delete']);
Route::post('/updateProduct/{id}',[ProductController::class,'update']);
Route::post('/admin/login',[ProductController::class,'loginAsAdminstrator']);
