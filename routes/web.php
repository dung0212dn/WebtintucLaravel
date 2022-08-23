<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Models\Categories;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', [PageController::class, 'index'])->name('page.index');

Route::get('/show/{id?}', [PageController::class, 'show'])->name('page.show');

Route::post('/show/{id?}', [PageController::class, 'commentstore'])->name('page.comment');

Route::get("/search", [PageController::class, 'search'])->name("page.search");

Route::get("/category/{id}", [PageController::class, 'categorynews'])->name("page.category");

Route::post('/', function (Request $request) {
    return $request->input('ckeditor');
})->name('home');

Route::group(['prefix' => '/auth'], function () {

    Route::get('/register', [AuthController::class, 'getUserRegister'])->name('auth.getRegister');
    Route::post('/register', [AuthController::class, 'postUserRegister'])->name('auth.postregister');

    Route::get('/login', [AuthController::class, 'getUserLogin'])->name('auth.getLogin');
    Route::post('/login', [AuthController::class, 'postUserLogin'])->name('auth.postlogin');

    Route::get('/logout', [AuthController::class, 'getUserLogout'])->name('auth.getLogout');

});

//UserAdminstrator
Route::resource('/user', UserController::class)->middleware('auth')->middleware('checkrole:admin');

//CategoriesAdminstrator
Route::resource('/categories', CategoriesController::class)->middleware('auth')->middleware('checkrole:admin');

//NewsAdminstrator
Route::resource('/news', NewsController::class)->middleware('auth');


