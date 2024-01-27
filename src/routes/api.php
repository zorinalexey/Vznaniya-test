<?php

use App\Http\Controllers\Api\V1\Users\DeleteController;
use App\Http\Controllers\Api\V1\Users\LoginController;
use App\Http\Controllers\Api\V1\Users\RegistrationController;
use App\Http\Controllers\Api\V1\Users\RestorePasswordController;
use App\Http\Controllers\Api\V1\Users\UpdateController;
use App\Http\Controllers\Api\V1\Users\ViewController;
use App\Http\Middleware\AuthTokenUser;
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

Route::post('login', LoginController::class)->name('login');
Route::post('registration', RegistrationController::class)->name('registration');
Route::post('restore_password', RestorePasswordController::class)->name('restore_password');

Route::prefix('users')->middleware(AuthTokenUser::class)->name('users.')->group(static function (){
    Route::get('{id}', ViewController::class)->name('view');
    Route::delete('{id}', DeleteController::class)->name('delete');
    Route::put('{id}', UpdateController::class)->name('update');
});
