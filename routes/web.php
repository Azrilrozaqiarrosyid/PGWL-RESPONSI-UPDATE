<?php

use App\Http\Controllers\MapController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PolylineController;
use App\Http\Controllers\PolygonController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MapController::class, 'index'])-> name('index');
Route::get('/table', [MapController::class, 'table'])-> name('table');

// create point
Route::post('/store-point', [PointController::class, 'store'])-> name('store-point');
// delete point
Route::delete('/delete-point/{id}', [PointController::class, 'destroy'])->name('delete-point');
// edit point
Route::get('/edit-point/{id}', [PointController::class, 'edit'])->name('edit-point');

// create polyline
Route::post('/store-polyline', [PolylineController::class, 'store'])->name('store-polyline');
// delete polyline
Route::delete('/delete-polyline/{id}', [PolylineController::class, 'destroy'])->name('delete-polyline');
// edit polyline
Route::get('/edit-polyline/{id}', [PolylineController::class, 'edit'])->name('edit-polyline');

// create polygon
Route::post('/store-polygon', [PolygonController::class, 'store'])-> name('store-polygon');
// delete polygon
Route::delete('/delete-polygon/{id}', [PolygonController::class, 'destroy'])->name('delete-polygon');
// edit polygon
Route::get('/edit-polygon/{id}', [PolygonController::class, 'edit'])->name('edit-polygon');

Route::get('/about', function () {
    return view('about');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// table
Route::get('/table-point', [PointController::class, 'table'])-> name('table-point');

require __DIR__.'/auth.php';
