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

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth.admin');
// Cleint router :: 
Route::get('/home',[homeController::class,'index'])->name('home');
Route::prefix('categories')->group(function () {
    //List of categories
    Route::get('/', [CategoriesController::class, 'index'])->name('categories.list');
    //Get details of a category (Apply show form to edit categories)
    Route::get('/edit/{id}', [CategoriesController::class, 'getCategory'])->name('categories.edit');
    //Handle updates chuyen muc
    Route::post('/edit/{id}', [CategoriesController::class, 'updateCategory']);
    //hien thi form add data
    Route::get('/add', [CategoriesController::class, 'addCategory'])->name('categories.add');
    //xu ly them chuyen muc/ handle add categorry
    Route::post('/add', [CategoriesController::class, 'handleAddCategory']);
    // delete category
    Route::delete('/delete/{id}', [CategoriesController::class, 'deleteCategory'])->name('categories.delete');
    // hien thi form upload
    Route::get('/upload', [CategoriesController::class, 'getFile']);
    //xu li file
    Route::post('/upload', [CategoriesController::class, 'handleFile'])->name('categories.upload');
});

Route::prefix('admin')->group(function(){
 
    Route::resource('products', ProductsController::class);
 
});
Route::get('san-pham/{id}', [HomeController::class, 'getProductDetail']);
// //Admin route
// Route::middleware('auth.admin')->prefix('admin')->group(function(){
//   Route::get('/',[DashboardController::class,'index']);
//   Route::resource('products',ProductsController::class)->middleware('auth.admin.product');
// });

Route::get('san-pham/{id}',[HomeController::class, 'getProductDetail']);

//Admin route
Route::middleware('auth.admin')->prefix('admin')->group(function(){
    Route::get('/',[DashboardController::class,'index']);
    Route::resource('products',ProductsController::class)->middleware('auth.admin.product');
});