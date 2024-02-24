<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::middleware(['auth'])->group(function () {
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// ->middleware(['auth'])   ログインしていたら  ->group(function ()へ実行
// 中身はKernel.php内の    
// protected $middlewareAliases = ['auth' => \App\Http\Middleware\Authenticate::class,]
Route::prefix('items')->middleware(['auth'])->group(function () {
    // 管理画面へ
    Route::get('/index', [App\Http\Controllers\ItemController::class, 'index']);
    // 一覧画面へ
    Route::get('/', [App\Http\Controllers\ItemController::class, 'used_item']);
    // データ削除
    Route::post('/{item}/delete', 
    [App\Http\Controllers\ItemController::class, 'delete']);
    // 登録フォーム表示
    Route::get('/add', 
    [App\Http\Controllers\ItemController::class, 'add']);
    // 登録実行
    Route::post('/add', 
    [App\Http\Controllers\ItemController::class, 'add']);
    // 編集フォーム表示
    Route::get('/{item}/edit', 
    [App\Http\Controllers\ItemController::class, 'edit']);
    // 編集実行
    Route::post('/{item}/edit', 
    [App\Http\Controllers\ItemController::class, 'edit']);
    // 入庫実行
    Route::post('/{item}/storing', 
    [App\Http\Controllers\ItemController::class, 'storing']);
    // 在庫持出
    Route::post('/{item}/take_out', 
    [App\Http\Controllers\ItemController::class, 'take_out']);
    // 検索機能(管理)
    Route::get('/itemsearch',
    [App\Http\Controllers\ItemController::class, 'itemsearch']);
    // 検索機能(ユーザー)
    Route::get('/used_itemsearch',
    [App\Http\Controllers\ItemController::class, 'used_itemsearch']);
});

// ->middleware(['auth'])   ログインしていたら  ->group(function ()へ実行
Route::prefix('users')->middleware(['auth'])->group(function () {
    // ユーザー一覧画面へ
    Route::get('/', [App\Http\Controllers\UserController::class,'index']);
    // データ削除
    Route::post('/{user}/delete',[App\Http\Controllers\UserController::class,'delete']);
    // 編集フォーム表示
    Route::get('/{user}/edit',[App\Http\Controllers\UserController::class,'edit']);
    // 編集実行
    Route::post('/{user}/edit',[App\Http\Controllers\UserController::class,'edit']);
    // 検索機能(ユーザー管理)
    Route::get('/usersearch',
    [App\Http\Controllers\UserController::class, 'usersearch']);
});



