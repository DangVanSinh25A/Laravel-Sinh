<?php

use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\admin\ProductsController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\HomeController;
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
    return '<h1>trang chủ</h1>';
})->name('home');

Route::get('/', function () {
    $title = 'Học lập trình';
    $content = 'Học lập trình laravel';
    // $data = [
    //     'title' => $title,
    //     'content' => $content
    // ];
    // return view('home', $data);
    return view('home', compact('title', 'content')); //cách 2
});


// Route::get('/', function () {
//     $user = new User();
//     $allUser = $user::all();
//     dd($allUser);
//     return view('welcome');
// });

Route::get('/form', function () {
    return view('form');
});


Route::post('/unicode/{slug}-{id}.html', function ($slug, $id) { //Sẽ hoạt động theo thứ tự khai báo. Sau tên thư mục
    $content = 'Phương thức Post của Path với tham số: ';
    $content .= 'id = ' . $id;
    $content .= 'slug = ' . $slug;
    return $content;
});
//Trường hợp tham số không bắt buộc
Route::post('/unicode/{id?}', function ($id = null) {
    $content = 'Phương thức Post của Path với tham số: ';
    $content .= 'id = ' . $id;
    return $content;
});
//Trường hợp tham số bắt buộc
Route::post('/unicode/{id}', function ($id) { //Sẽ trả về lỗi
    $content = 'Phương thức Post của Path với tham số: ';
    $content .= 'id = ' . $id;
    return $content;
});
//validate url bằng phương thức where
Route::post('/unicode/{slug}-{id}.html', function ($slug, $id) {
    $content = 'Phương thức Post của Path với tham số: ';
    $content .= 'id = ' . $id;
    $content .= 'slug = ' . $slug;
    return $content;
})->where(
    [
        'slug' => '.+',
        'id' => '[0-9]+'
    ]
);

Route::get('/unicode', function () {
    return "Phương thức Get của Path";
});

Route::put('/unicode', function () {
    return "Phương thức Put của Path";
});

Route::delete('/unicode', function () {
    return "Phương thức delete của Path";
});

Route::patch('/unicode', function () {
    return "Phương thức patch của Path";
});

Route::match(['get', 'post'], '/unicode', function () {
    return $_SERVER['REQUEST_METHOD'];
});

Route::get('/show-form', function () {
    return view('form');
});

Route::any('/unicode', function (Request $request) {
    return $request->method();
});

Route::redirect('/unicode', 'show-form', 404);

Route::view('show-form', 'form');

Route::prefix('admin')->group(function () {
    Route::get('unicode', function () {
        return 'Phương thức Get của path /unicode';
    });
    Route::get('show-form', function () {
        return view('form');
    })->name('admin.show-form');

    Route::prefix('products')->group(function () {
        Route::get('/', function () {
            return 'Danh sách sản phẩm';
        });
        Route::get('add', function () {
            return 'Thêm sản phẩm';
        });
        Route::get('edit', function () {
            return 'Sửa sản phẩm';
        });
        Route::get('delete', function () {
            return 'Xoá sản phẩm';
        });
    });
});

// Route::get('/', [HomeController::class], 'index')->name('home')->middleware('auth.admin');
Route::get('/', [HomeController::class, 'index']);
Route::middleware('auth.admin')->prefix('categories')->group(function () {
    //Lấy danh sách chuyên mục
    Route::get('/', [CategoriesController::class, 'index'])->name('categories.list');

    //Lấy chi tiết một chuyên mục
    Route::get('/edit/{id}', [CategoriesController::class, 'getCategories'])->name('categories.edit');;


    //xử lí update chuyên mục
    Route::post('/edit/{id}', [CategoriesController::class, 'udateCategories']);;

    //Hiển thị form add dl
    Route::get('/add', [CategoriesController::class, 'addCategories'])->name('categories.add');;

    //xử lý thêm chuyên mục
    Route::post('/add', [CategoriesController::class, 'handleAddCategories']);

    //xoá chuyên mục
    Route::delete('/delete/{id}', [CategoriesController::class, 'deleteCategories'])->name('categories.delete');

    //Xử lí file
    Route::Post('/upload', [CategoriesController::class, 'handleFile']);
});

//admin route
Route::middleware('auth.admin')->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::middleware('auth.admin.product')->resource('products', ProductsController::class);
});

Route::get('/san-pham', [HomeController::class, 'products']);
Route::get('/themsanpham', [HomeController::class, 'getAdd']);
Route::post('/them-san-pham', [HomeController::class, 'postAdd']);
// Route::put('/themsanpham', [HomeController::class, 'putAdd']);