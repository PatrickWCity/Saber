<?php

use Illuminate\Http\Request;

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

Route::apiResources([
    'usuario' => 'API\UsuarioController',
    'perfil' => 'API\PerfilController',
    'submodulo' => 'API\SubmoduloController',
    'modulo' => 'API\ModuloController',
    'perfilusuario' => 'API\PerfilUsuarioController',
    'moduloperfil' => 'API\ModuloPerfilController',
    'submodulomodulo' => 'API\SubmoduloModuloController',
    'habilitarusuario' => 'API\HabilitarController',
    'deshabilitarusuario' => 'API\DeshabilitarController',
    'usuariopendiente' => 'API\PendienteController',
    'noticia' => 'API\NoticiaController',
    'tiponoticia' => 'API\TipoNoticiaController',
    'documento' => 'API\DocumentoController',
    'tipodocumento' => 'API\TipoDocumentoController',
    'evento' => 'API\EventoController',
    'tipoevento' => 'API\TipoEventoController',
    'voluntario' => 'API\VoluntarioController',
    'sede' => 'API\SedeController',
    'area' => 'API\AreaController',
    'user' => 'API\UserController',
    'expositor' => 'API\ExpositorController',
    'tipovoluntario' => 'API\TipoVoluntarioController',
    'dashboard' => 'API\DashboardController'
]);

Route::get('cuenta', 'API\UserController@cuenta');
Route::put('cuenta', 'API\UserController@actualizarCuenta');