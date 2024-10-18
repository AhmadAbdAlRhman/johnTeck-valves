<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;

Route::post('/storage',[ProductController::class,'store']);


Route::get('/', function () {
    return view('welcome');
});
