<?php

use App\Http\Controllers\Comments;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Recipes;
use App\Http\Controllers\User;

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

Route::get('/', [Recipes::class, 'home']);
Route::get('/search/{string}', [Recipes::class, 'search']);
Route::get('/error/500', function (){abort(500);});
Route::get('/recipe/{id}', [Recipes::class, 'recipe']);

Route::get('/login', [User::class, 'login']);
Route::get('/register', [User::class, 'register']);

Route::get('/add', [])->middleware('auth');
Route::post('/comment/{id}', [Comments::class, 'add'])->middleware('auth');

Route::post('/login', [User::class, 'verify'])->name('login');
Route::post('/register', [User::class, 'add'])->name('register');
Route::get('/logout', [User::class, 'unverify']);
