<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\DashboardController;
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
// Cách cũ 
Route::get('/','App\Http\Controllers\HomeController@index' )->name('home');

Route::get('/news','HomeController@getNews' )->name('news');

// Cách mới:
Route::get('/category/{id}', [HomeController::class, 'getCategory']) ;

Route::prefix('admin')->group(function () {
  
  Route::get('/laravel/{id?}/{slug?}.html', function ($id=null,$slug=null) {
    $content = "Phương thức get của path laravel với  tham số : ";
    $content.='id = '.$id.'<br/>';
    $content.='slug = '.$slug.'<br/>';

    return $content;
  })->where('id','\d')->where('slug','.+')->name('admin.laravel');


  Route::get('/show-form', function () {
    return view('form');
  })->name('admin.show-form');

  Route::prefix('/products')->middleware('checkpermission')->group(function () {
    Route::get('/', function () {
      return 'Danh sách sản phẩm';
    });

     Route::get('/add', function () {
      return 'Thêm sản phẩm';
    })->name('admin.products.add');

     Route::get('/edit', function () {
      return 'Sửa sản phẩm';
    });
  });
});

// Cleint router :: 
Route::prefix('category')->group(function() {
  // danh sách chuyên mục
    Route::get('/',[CategoriesController::class, 'index'])->name('categories.list');

  Route::get('/edit/{id}', [CategoriesController::class,'getCategory'])->name('categories.edit');

  Route::post('/edit/{id}', [CategoriesController::class, 'updateCategory'])->name('categories');

  //Hiển thị form add dữ liệu 
  Route::get('/add', [CategoriesController::class, 'addCategory'])->name('categories.add');

  Route::post('/add', [CategoriesController::class, 'handleAddcategory']);

  // Xóa chuyên mục
  Route::delete('/delete/{id}', [CategoriesController::class, 'deleteCategory']);

});

Route::prefix('admin')->group(function(){
 
    Route::resource('products', ProductsController::class);
 
});
//Admin route
Route::middleware('auth.admin')->prefix('admin')->group(function(){
  Route::get('/',[DashboardController::class,'index']);
  Route::resource('products',ProductsController::class)->middleware('auth.admin.product');
});