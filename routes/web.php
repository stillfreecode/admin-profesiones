<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeProductController;

Route::get('/', function () {return view('welcome');});
// Route::get('/ruta1', function(){return 'cadena de la ruta1';});
/*
Route::get('/usuarios/detalles', function(){
           return 'Mostrando el detalle del    usario: ' . $_GET['id'];}
          );
*/
Route::get('/usuarios/{user}',[UserController::class,'show'])->
                                        where('user','[0-9]+')->
                                        name('users.show');

                                        /*
Route::get('productos/{sku}/{nombre?}',
        [WelcomeProductController::class,'index']);
*/

Route::get('/usuarios',[UserController::class,'index'])->name('users.index');

Route::get('/usuarios/nuevo', [UserController::class, 'create'])->name('users.create');

Route::post('/usuarios/', [UserController::class, 'store']);

Route::get('/usuarios/{user}/editar', [UserController::class, 'edit'])->name('users.edit');

Route::put('/usuarios/{user}', [UserController::class, 'update'])->name('users.update');

route::delete('/usuarios/{user}', [UserController::class, 'destroy'])->name('users.destroy');