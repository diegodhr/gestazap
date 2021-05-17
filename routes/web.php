<?php

use App\Http\Controllers\AdminLog;
use App\Http\Controllers\AdminlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\VentasController;
use App\Models\User;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', 'App\Http\Controllers\LoginController@index');
// Route::post('/validar', [LoginController::class, 'validar']);
// Route::view('/', 'welcome');
// Route::view('login', 'login');
// Route::view('dashboard', 'dashboard');
// Route::get('/nuevacat', [AdminlogController::class, 'categoria']);
// Route::post('/nuevacat', [AdminlogController::class, 'nueva_categoria']);

// Route::get('/dashboard/empleado', [EmpleadosController::class, 'index']);
// Route::resource('/dashboard/empleado', EmpleadosController::class);

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'login']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::post('/dashboard/producto/buscar', [ProductosController::class, 'buscar_producto']);
Route::post('/dashboard/producto/guardar_producto', [ProductosController::class, 'guardar_producto']);
Route::post('/dashboard/producto/nueva_talla', [ProductosController::class, 'nueva_talla'])->name('producto.talla');
Route::resource('/dashboard/producto', ProductosController::class);

Route::post('/venta/finalizar', [VentasController::class,'finalizar'])->name('venta.finalizar');
Route::post('/venta/cancelar', [VentasController::class,'cancelar']);
Route::resource('/venta', VentasController::class);

Route::post('/logout', [LoginController::class, 'logout']);
