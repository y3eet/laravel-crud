<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/register', [AuthController::class, 'showRegister'])->name('show.register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function (Request $request) {
    $user = $request->user();
    if ($user) {
        return redirect()->route('posts.index');
    }
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/posts', function () {
        return view('posts.index');
    })->name('posts.index');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
});
Route::prefix('/api')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::post('/user', function (Request $request) {
            return $request->user();
        });
        Route::post('/user/theme', [AuthController::class, 'setTheme']);

        Route::put('/like/{post}', [LikeController::class, 'like']);
        Route::delete('/like/{post}', [LikeController::class, 'unlike']);

        Route::get('/comment', [CommentController::class, 'index']);
        Route::post('/comment', [CommentController::class, 'store']);
        Route::delete('/comment/{id}', [CommentController::class, 'delete']);

        Route::get('/posts', [PostController::class, 'index'])->name('api.posts.index');
        Route::post('/posts', [PostController::class, 'store'])->name('api.posts.store');
        Route::put('/posts/{post}', [PostController::class, 'update'])->name('api.posts.update');
        Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('api.posts.destroy');
    });
});
