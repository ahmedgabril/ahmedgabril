<?php


use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Handelcustomer;
use App\Http\Livewire\Getgen;
use App\Http\Livewire\Getdrows;
use App\Http\Livewire\Getsheepment;
use App\Http\Livewire\Stores;
use App\Http\Livewire\Expens;
use App\Http\Livewire\Getvideo;
use App\Http\Livewire\Getadds;

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
    return view('manapp');
});
Route::get('/2020', function () {
    return view('auth\login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/2020/bransh',App\Http\livewire\Bransh::class)->name('bransh');
Route::get('/2020/stores',Stores::class)->name('srores');
Route::get('/2020/customer',Handelcustomer::class)->name('customer');
Route::get('/2020/drow',Getdrows::class)->name('drow');
Route::get('/2020/genry',Getgen::class)->name('genry');
Route::get('/2020/seepment',Getsheepment::class)->name('sheepment');
Route::get('/2020/expens',Expens::class)->name('expens');
Route::get('/2020/adds',Getadds::class)->name('adds');
Route::get('/2020/addvideo',Getvideo::class)->name('video');



