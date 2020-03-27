<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources(['user'=>'API\UserController']);

Route::apiResources(['puestos'=>'API\PuestosController']);
Route::apiResources(['departamentos'=>'API\DepartamentosController']);
Route::apiResources(['planilla'=>'API\PlanillaController']);
Route::apiResources(['deducciones'=>'API\DeduccionesController']);
Route::apiResources(['horarios'=>'API\HorariosController']);
Route::apiResources(['empleados'=>'API\EmpleadosController']);
