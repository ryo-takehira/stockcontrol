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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('items')->group(function () {
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
});




