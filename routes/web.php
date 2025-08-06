<?php

use App\Livewire\CekComplaint;
use App\Livewire\Home;
use App\Livewire\MakeComplaint;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::get('/', Home::class)->name('home');
Route::get('/buat-aduan', MakeComplaint::class)->name('complaint.create');
Route::get('/cek-aduan', CekComplaint::class)->name('complaint.check');
