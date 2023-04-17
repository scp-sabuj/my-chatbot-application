<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;

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

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Route::get('/migrate-link', function () {
    // Artisan::call('migrate:fresh');
    return "Success";
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return "Success";
});


Route::get('/', [PublicController::class, 'welcome'])->name('welcome');
Route::post('send-message', [PublicController::class, 'send_message'])->name('send.message');

require __DIR__.'/auth.php';
// require __DIR__.'/admin-auth.php';
