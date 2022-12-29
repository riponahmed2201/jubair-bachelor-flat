<?php

use App\Http\Controllers\API\RegisterController;
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

Route::group(array('middleware' => ['web']), function () {
    Route::get('/api/v1/admin/list', [RegisterController::class, 'getAllAdminList']);
    Route::get('/api/v1/admin/info/{id}', [RegisterController::class, 'getAllAdminInfo']);
    Route::get('/api/v1/admin/delete/{id}', [RegisterController::class, 'deleteAdminInfo']);
    Route::get('/api/v1/admin/register', [RegisterController::class, 'adminRegister']);
    Route::get('/api/v1/admin/update/{id}', [RegisterController::class, 'updateAdminInfo']);
});
