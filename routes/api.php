<?php

use App\Http\Controllers\PolygonController;
use App\Http\Controllers\PolylineController;
use App\Http\Controllers\PointController;
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

// GeoJSON Point
Route::get('/points', [PointController::class, 'index'])->name('api.points');
// GeoJSON Point edit
Route::get('/point/{id}', [PointController::class, 'show'])->name('api.point');

// GeoJSON Polylines
Route::get('/polylines', [PolylineController::class, 'index'])->name('api.polylines');
// GeoJSON Polyline
Route::get('/polyline/{id}', [PolylineController::class, 'show'])->name('api.polyline');

// GeoJSON Polygons
Route::get('/polygons', [PolygonController::class, 'index'])->name('api.polygons');
// GeoJSON Polygon
Route::get('/polygon/{id}', [PolygonController::class, 'show'])->name('api.polygon');
