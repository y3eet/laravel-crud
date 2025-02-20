<?php

use App\Http\Controllers\AuthController;
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
});
Route::prefix('api')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::post('/user', function (Request $request) {
            return $request->user();
        });
        Route::apiResource('/posts', PostController::class)->names([
            'index' => 'api.posts.index',
            'store' => 'api.posts.store',
            'show' => 'api.posts.show',
            'update' => 'api.posts.update',
            'destroy' => 'api.posts.destroy',
        ]);
    });
});
