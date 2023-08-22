<?php

use App\Http\Controllers\PostController;
use App\Http\Livewire\Posts\PostCreate;
use App\Http\Livewire\Posts\PostRead;
use App\Http\Livewire\Posts\PostTable;
use App\Http\Livewire\Posts\PostUpdate;
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

Route::get('/', function () {
    return redirect()->to('/posts');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/posts/create', PostCreate::class)->name('posts.create');
    Route::get('/posts/{post}/edit', PostUpdate::class)->name('posts.update');
});

Route::get('/posts', PostTable::class)->name('posts.index');
Route::get('/posts/{slug}', PostRead::class)->name('posts.read');
