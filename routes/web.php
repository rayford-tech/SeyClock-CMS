<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    // return view('dashboard');
    return redirect()->route('backend.clockins');
})->middleware(['auth'])->name('dashboard');

Route::group(['as' => 'backend.', 'middleware' => ['auth']], function () {
    Route::get('users', [DashboardController::class, 'Users'])->name('users');
    Route::post('users', [DashboardController::class, 'PostUsers'])->name('users');
    Route::get('edit-users/{id}', [DashboardController::class, 'EditUsers'])->name('users.edit');
    Route::post('edit-users/{id}', [DashboardController::class, 'UpdateUsers'])->name('users.edit');

    Route::get('configs', [DashboardController::class, 'Configs'])->name('configs');
    Route::post('configs', [DashboardController::class, 'PostConfigs'])->name('configs');

    Route::get('clockins', [DashboardController::class, 'Clockins'])->name('clockins');
});

Route::group(['prefix' => 'admin/api', 'as' => 'backend.admin.api.'], function () {
    //add admin middleware later to this route
    Route::get('delete-user/{id?}', [DashboardController::class, 'DeleteUser'])->name('delete.user');
});
require __DIR__.'/auth.php';
