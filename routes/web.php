<?php

use App\Models\Blog;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Blogs;
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

 Route::get('/', [\App\Http\Controllers\BlogController::class,'index'])->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::get('blog', Blogs::class)->name('blog');

Route::get('show/{id}',[\App\Http\Controllers\BlogController::class,'show'])->name('show');
