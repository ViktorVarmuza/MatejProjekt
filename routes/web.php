<?php

use App\Http\Controllers\Etapy;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Race;
use App\Http\Controllers\RaceDetail;

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



Route::get('/', [Race::class, 'show'])
    ->name('home');

Route::get('/race/{id}', [RaceDetail::class, 'show'])
    ->name('race');

Route::get('/etapy/{id}', [Etapy::class, 'show'])
    ->name('etapy');

Route::delete('/race/{id}', [RaceDetail::class, 'destroy'])
    ->name('race.delete');

Route::post('/race', [RaceDetail::class, 'create'])
    ->name('race.create');

Route::put('/race/edit', [RaceDetail::class, 'edit'])
    ->name('race.edit');
