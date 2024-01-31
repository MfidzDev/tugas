<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route Login
Route::post('/login', [App\Http\Controllers\Api\Auth\LoginController::class, 'index']);


// group route with middleware "auth"
Route::group(['middleware' => 'auth:api'], function () {
    // logout
    Route::post('/logout', [App\Http\Controllers\Api\Auth\LoginController::class, 'logout']);
});


// group route with prefix "admin"
Route::prefix('admin')->group(function () {
    // group route with middleware "auth:api"
    Route::group(['middleware' => 'auth:api'], function () {
        // Dashboard
        Route::get('/dashboard', App\Http\Controllers\Api\Admin\DashboardController::class);

        // Permissions
        Route::get('/permissions', [App\Http\Controllers\Api\Admin\PermissionController::class, 'index'])->middleware('permission:permissions.index');

        // Permissions all
        Route::get('permissions/all', [App\Http\Controllers\Api\Admin\PermissionController::class, 'all'])->middleware('permission:permissions.index');

        // Roles all
        Route::get('/roles/all', [\App\Http\Controllers\Api\Admin\RoleController::class, 'all'])->middleware('permission:roles.index');

        // Roles
        Route::apiResource('/roles', App\Http\Controllers\Api\Admin\RoleController::class)->middleware('permission:roles.index|roles.store|roles.update|roles.delete');

        // Users
        Route::apiResource('/users', App\Http\Controllers\Api\Admin\UserController::class)->middleware('permission:users.index|users.store|users.update|users.delete');

        // Categories all
        Route::get('/categories/all', [App\Http\Controllers\Api\Admin\CategoryController::class, 'all'])->middleware('permission:categories.index');

        // Categories
        Route::apiResource('/categories', App\Http\Controllers\Api\Admin\CategoryController::class)->middleware('permission:categories.index|categories.store|categories.update|categories.delete');

        //Post
        Route::apiResource('/posts', App\Http\Controllers\Api\Admin\PostController::class)->middleware('permission:posts.index|posts.store|posts.update|posts.delete');
    });
});