<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/laravel', function () {
    return view('home');

    // $user= new User();
    // $allUser= $user::all();
    // dd($allUser);
});
Route::get('/product', function () {
   return view('product');
});
Route::prefix('admin')->group(function(){
    Route::get('unicode', function(){
        return 'Phương thức Get của path/unicode';
    });
    Route::get('show-form', function(){
        return view('form');
    });
    Route::prefix('products')->group(function(){
        Route::get('/', function(){
            return 'Danh sách sản phẩm';
        });
        Route::get('add', function(){
            return 'Thêm sản phẩm';
        });
        Route::get('edit', function(){
            return 'Sửa sản phẩm';
        });
        Route::get('delete', function(){
            return "Xóa sản phẩm";
        });
    });
});