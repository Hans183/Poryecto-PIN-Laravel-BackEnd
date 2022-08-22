<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/* RUTAS DE CONTACTO  */

Route::post('Contacto', [ContactoController::class, 'store']); //Lo crea en la DB

Route::get('Contactos', [ContactoController::class, 'index']); //Muestra Todos

/* RUTAS DE USER  */

Route::post('insertUser', [UserController::class, 'store']);

Route::get('getUser/{id}', [UserController::class, 'show']);

Route::get('Users', [UserController::class, 'index']);

Route::put('updateUser/{id}', [UserController::class, 'update']);

Route::delete('deleteUser/{id}', [UserController::class, 'destroy']);

/* RUTAS DE POST  */

Route::post('insertPost', [PostController::class, 'store']);

Route::get('getPost/{id}', [PostController::class, 'show']);

Route::get('Posts', [PostController::class, 'index']);

Route::put('updatePost/{id}', [PostController::class, 'update']);

Route::delete('deletePost/{id}', [PostController::class, 'destroy']);
