<?php
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/products', [ProductController::class,'index']);
Route::get('/product', [ProductController::class,'ShowById']);
Route::post('/storage',[ProductController::class,'store']);
Route::get('/products/{nameProducts}', [ProductController::class,'search']);
