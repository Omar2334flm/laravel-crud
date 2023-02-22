<?php

use App\Http\Livewire\Cities\CityIndex;
use App\Http\Livewire\Countries\CountryIndex;
use App\Http\Livewire\Departments\DepartmentIndex;
use App\Http\Livewire\Employments\EmployeeIndex;
use App\Http\Livewire\States\StateIndex;
use App\Http\Livewire\Users\UserIndex;
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

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function(){
    Route::view('/dashboard','dashboard')->name('dashboard');
    Route::get('/users',UserIndex::class)->name('userindex');
    Route::get('/Countries',CountryIndex::class)->name('countryindex');
    Route::get('/States',StateIndex::class)->name('stateindex');
    Route::get('/Cities',CityIndex::class)->name('cityindex');
    Route::get('/Departments',DepartmentIndex::class)->name('departmentindex');
    Route::get('/Employments',EmployeeIndex::class)->name('employeeindex');





  




});