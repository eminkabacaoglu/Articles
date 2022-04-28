<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;

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
    return view('home');
});

Route::get('articles',[ArticleController::class,'index']);
//Route::get('articles',['App\Http\Controllers\ArticleController','index']);// bu şekilde de yazılabilirdi

//dd(ArticleController::class); //"App\Http\Controllers\ArticleController" bu değeri döndürür

// Route::get('articles/new', function () {
//     return "yeni article ekleme formu";
// });
Route::get('articles/new',array(ArticleController::class,'create')); // bu şekilde de yazılabilir


// Route::get('articles/{id}', function ($id) {
//     return $id." numaralı article";
// });
Route::get('articles/{id}',[ArticleController::class,'show'])->name('articles.goster');

Route::get('articles/edit/{id}/{usr}',[ArticleController::class,'edit'])->middleware('author');

Route::get('articles/delete/{id}',[ArticleController::class,'destroy']);

Route::get('categories/{category}/follow', [CategoryController::class, 'follow'])->name('categories.follow');
Route::get('categories/{category}/unfollow', [CategoryController::class, 'unfollow'])->name('categories.unfollow');

// Route::post('articles', function () {
//     return "yeni article ekleme işlemi";
// });
Route::post('articles',[ArticleController::class,'store']);

Route::put('articles/{id}',[ArticleController::class,'update']);


Route::resource('categories',CategoryController::class);



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
