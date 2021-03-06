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

Route::get('totourial/{totourial}/edit', [TotourialController::class, 'edit'])->name('totourial.edit');

Route::patch('totourial/{totourial}/update', [TotourialController::class, 'update'])->name('totourial.update');

Route::post('store/totourial', [TotourialController::class, 'store'])->name('totourial.store')->middleware('auth');

Route::get('create/totourial', [TotourialController::class, 'create'])->middleware('auth')->name('totourial.create')->middleware('auth');

Route::post('{totourial}/tasks', [TaskController::class, 'store'])->name('task.store')->middleware('auth');

Route::patch('totourial/{totourial}/task/{task}', [TaskController::class, 'update'])->name('task.update')->middleware('auth');

Route::delete('totourial/{totourial}', [TotourialController::class, 'destroy'])->name('totourial.destroy');

Route::post('invite/{totourial}', [TotourialController::class, 'inviteFriends'])->name('invite');


Route::get('send',[TotourialController::class,'notif']);
require __DIR__ . '/auth.php';
