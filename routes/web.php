<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TotourialController;
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
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('totourials', [TotourialController::class, 'index'])->name('totourial.index');

Route::get('totourial/{totourial}', [TotourialController::class, 'show'])->name('totourial.show');

Route::post('totourials', [TotourialController::class, 'store'])->name('totourial.store')->middleware('auth');

Route::get('create', [TotourialController::class, 'create'])->middleware('auth')->name('totourial.create')->middleware('auth');

Route::post('task/{post}', [TaskController::class, 'store'])->name('task.store')->middleware('auth');

require __DIR__.'/auth.php';
