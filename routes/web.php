<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

// Controllers ventas
use App\Http\Controllers\ventas\detalleventaController;
use App\Http\Controllers\ventas\ventaController;

// Controllers productos
use App\Http\Controllers\productos\productoController;
use App\Http\Controllers\productos\productoinventarioController;

// Controllers inventario
use App\Http\Controllers\inventario\materiaprimaController;
use App\Http\Controllers\inventario\inventmateriaprimaController;
use App\Http\Controllers\inventario\prodmateriaprimaController;

// Controllers cliente
use App\Http\Controllers\cliente\clienteController;
use App\Http\Controllers\cliente\companiaController;
use App\Http\Controllers\cliente\direccionclienteController;
use App\Http\Controllers\cliente\oficinaController;
use App\Http\Controllers\cliente\correosController;
use App\Http\Controllers\cliente\telefonosController;

// Controllers empleado
use App\Http\Controllers\empleados\empleadoController;
use App\Http\Controllers\empleados\pagosalarioController;
use App\Http\Controllers\empleados\datosempleController;

// Controllers seguridad
use App\Http\Controllers\seguridad\bitacoraController;
use App\Http\Controllers\seguridad\rolusuarioController;
use App\Http\Controllers\seguridad\tipoperacionController;

//Controllers roles
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;

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

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


// Route ventas
Route::resource('detalleventas',detalleventaController::class)->names('detalleventas');
Route::resource('ventas',ventaController::class)->names('ventas');

// Route productos
Route::resource('productos',productoController::class)->names('productos');
Route::resource('productosinventario',productoinventarioController::class)->names('productosinventario');

// Route inventario
Route::resource('materiaprima',materiaprimaController::class)->names('materiaprima');
Route::resource('inventariomateriaprima',inventmateriaprimaController::class)->names('inventariomateriaprima');
Route::resource('productomateriaprima',prodmateriaprimaController::class)->names('productomateriaprima');

// Route cliente
Route::resource('cliente',clienteController::class)->names('cliente');
Route::resource('compania',companiaController::class)->names('compania');
Route::resource('direccioncliente',direccionclienteController::class)->names('direccioncliente');
Route::resource('oficina',oficinaController::class)->names('oficina');
Route::resource('correos',correosController::class)->names('correos');
Route::resource('telefonos',telefonosController::class)->names('telefonos');

// Route empleados
Route::resource('pagosalario',pagosalarioController::class)->names('pagosalario');

// Route seguridad
Route::resource('bitacora',bitacoraController::class)->names('bitacora');
Route::resource('tipoperacion',tipoperacionController::class)->names('tipoperacion');

// Route roles
Route::resource('roles',RolController::class)->names('roles');
Route::resource('usuarios',UsuarioController::class)->names('usuarios');