<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\App\HomeController;
use App\Http\Controllers\App\ItemController;
use App\Http\Controllers\App\CategoriaController;
use App\Http\Controllers\App\EmpresaController;
use App\Http\Controllers\App\UserController;

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
    return view('auth.login');
});

Auth::routes();

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/itens',[ItemController::class, 'Index'])->name('itens');
    Route::get('/itens_inativos',[ItemController::class, 'showItensInativos'])->name('itens_inativos');
    Route::get('/full_itens',[ItemController::class, 'showFullItens'])->name('full_itens');
    Route::get('/item_detalhe/{id}',[ItemController::class, 'show'])->name('item_detalhe');

    Route::get('/categorias',[CategoriaController::class, 'index'])->name('categorias');

    Route::get('/empresas',[EmpresaController::class, 'index'])->name('empresas');
    Route::get('/empresa_detalhe/{id}',[EmpresaController::class, 'show'])->name('empresa_detalhe');
    Route::get('/itens_empresa/{id}',[EmpresaController::class, 'showItensEmpresa'])->name('itens_empresa');
    Route::get('/show_perfil_user/{id}', [UserController::class, 'profileUser'])->name('show_perfil_user');
    Route::post('/alter_password/{id}', [UserController::class, 'alterPassword'])->name('alter_password');


Route::middleware(['techuser'],['adminuser'])->group(function (){


    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/perfil_user/{id}', [UserController::class, 'show'])->name('perfil_user');

    Route::get('/cadastro_itens',[ItemController::class, 'create'])->name('cadastro_itens');
    Route::post('/new_item',[ItemController::class, 'store'])->name('new_item');
    Route::put('/update_item/{id}',[ItemController::class, 'update'])->name('update_item');

    Route::post('/new_categoria',[CategoriaController::class, 'store'])->name('new_categoria');
    Route::put('/update_categoria/{id}',[CategoriaController::class, 'update'])->name('update_categoria');

    Route::post('/new_empresa',[EmpresaController::class, 'store'])->name('new_empresa');
    Route::put('/update_empresa/{id}',[EmpresaController::class, 'update'])->name('update_empresa');

});


Route::middleware(['adminuser'])->group(function (){
    Route::delete('/delete_item/{id}', [ItemController::class, 'destroy'])->name('delete_item');
    Route::delete('/delete_photo/{id}', [ItemController::class, 'destroyPhoto'])->name('delete_photo');

    Route::delete('/delete_empresa/{id}', [EmpresaController::class, 'destroy'])->name('delete_empresa');
    Route::delete('/delete_categoria/{id}', [CategoriaController::class, 'destroy'])->name('delete_categoria');

    Route::post('/new_user', [UserController::class, 'create'])->name('new_user');
    Route::put('/update_user/{id}',[UserController::class, 'update'])->name('update_user');
    Route::delete('/delete_user/{id}', [UserController::class, 'destroy'])->name('delete_user');

});


