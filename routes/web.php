<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/',[TaskController::class,'index'])->name('index');


Route::group(['middleware' => 'auth'], function() {

    //home画面の表示
    Route::get('/', [HomeController::class,'home'])->name('home');

    //folder作成機能
    Route::get('/folders/create', [FolderController::class,'showCreateForm'])->name('showCreateForm');
    Route::post('/folders/create', [FolderController::class,'create'])->name('create');

    Route::group(['middleware' => 'can:view,folder'], function() {
        Route::get('/folders/{folder}/tasks', [TaskController::class,'index'])->name('tasks.index');
        // http://localhost/folders/1/tasks

        //task作成機能
        Route::get('/folders/{folder}/tasks/create', [TaskController::class,'showTaskCreateForm'])->name('showTaskCreateForm');
        Route::post('/folders/{folder}/tasks/create', [TaskController::class,'taskCreate'])->name('taskCreate');


        //task編集機能
        Route::get('/folders/{folder}/tasks/{task}/edit', [TaskController::class,'showEditForm'])->name('showEditForm');
        Route::post('/folders/{folder}/tasks/{task}/edit', [TaskController::class,'edit'])->name('edit');
    });

});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//会員登録・ログイン・ログアウト・パスワード再設定の各機能ルーティング設定。
Auth::routes();