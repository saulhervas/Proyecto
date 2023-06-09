<?php

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

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;

Route::get('intranet', 'Seguridad\LoginController@index')->name('login');
Route::post('intranet/login', 'Seguridad\LoginController@login')->name('login_post');
Route::post('login', 'Seguridad\LoginController@login')->name('login_post2');
Route::get('logout', 'Seguridad\LoginController@logout')->name('logout');

Route::get('registro', 'Seguridad\RegistersUsers@index')->name('register');
Route::post('registro', 'Seguridad\RegistersUsers@register')->name('register_post');

Route::get('password/reset', 'Seguridad\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Seguridad\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Seguridad\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Seguridad\ResetPasswordController@reset')->name('password.update');

Route::get('/', 'PaginaWebController@index')->name('pagina_web');
Route::get('/web/habitaciones', 'PaginaWebController@habitaciones')->name('pagina_web_habitaciones');
Route::get('/web/habitacion/{id}', 'PaginaWebController@habitacion')->name('pagina_web_habitacion');
Route::get('/web/servicios', 'PaginaWebController@servicios')->name('pagina_web_servicios');
Route::get('/web/galeria', 'PaginaWebController@galeria')->name('pagina_web_galeria');
Route::get('/web/introduccion', 'PaginaWebController@introduccion')->name('pagina_web_introduccion');
Route::get('/web/contacto', 'PaginaWebController@contacto')->name('pagina_web_contacto');
Route::get('/web/registro', 'PaginaWebController@registro')->name('pagina_web_registro');
Route::get('/web/login', 'PaginaWebController@login')->name('pagina_web_login');
Route::post('/web/contacto', 'ContactoWebController@guardar')->name('guardar_contacto');
Route::post('/web/suscripcion', 'SuscripcionController@suscripcion')->name('suscripcion');
Route::get('/web/suscripcion/{id}', 'SuscripcionController@cancelar')->name('cancelar_suscripcion');
Route::get('/web/servicio/{id}', 'PaginaWebController@servicio')->name('pagina_web_servicio');
Route::post('/web/buscar-periodo', 'PaginaWebController@buscar_periodo')->name('pagina_web_periodo');
Route::get('/web/crear-reserva', 'PaginaWebController@reserva')->name('pagina_web_reserva');
Route::post('/web/reserva', 'PaginaWebController@guardar_reserva')->name('pagina_web_reserva_guardar');

Route::group(['middleware' => 'auth'], function () {
    Route::get('web', 'PaginaWebController@index')->name('web');

    Route::get('inicio', 'NoticiaController@index')->name('inicio');

    /*RUTAS DE NOTICIAS*/
    //Route::get('noticia', 'NoticiaController@index')->name('noticia');
    Route::get('noticia/crear', 'NoticiaController@crear')->name('crear_noticia');
    Route::post('noticia', 'NoticiaController@guardar')->name('guardar_noticia');
    Route::get('noticia/{id}/editar', 'NoticiaController@editar')->name('editar_noticia');
    Route::put('noticia/{id}', 'NoticiaController@actualizar')->name('actualizar_noticia');
    Route::delete('noticia/{id}', 'NoticiaController@eliminar')->name('eliminar_noticia');

    /*RUTAS DE PERSONAL*/
    Route::get('personal', 'PersonalController@index')->name('personal');
    Route::post('personal/busqueda', 'PersonalController@busqueda')->name('busqueda_personal');
    Route::get('personal/crear', 'PersonalController@crear')->name('crear_personal');
    Route::post('personal', 'PersonalController@guardar')->name('guardar_personal');
    Route::get('personal/{id}/editar', 'PersonalController@editar')->name('editar_personal');
    Route::put('personal/{id}', 'PersonalController@actualizar')->name('actualizar_personal');
    Route::delete('personal/{id}', 'PersonalController@eliminar')->name('eliminar_personal');
    Route::get('personal/export/', 'PersonalController@export')->name('exportar_personal');
    Route::get('personal/{id}/conectar/', 'PersonalController@conectar')->name('conectar_personal');

    /*RUTAS DE TIPOS HABITACIONES*/
    Route::get('tipo-habitacion', 'TipoHabitacionController@index')->name('tipo_habitacion');
    Route::get('tipo-habitacion/crear', 'TipoHabitacionController@crear')->name('crear_tipo_habitacion');
    Route::post('tipo-habitacion', 'TipoHabitacionController@guardar')->name('guardar_tipo_habitacion');
    Route::get('tipo-habitacion/{id}/editar', 'TipoHabitacionController@editar')->name('editar_tipo_habitacion');
    Route::put('tipo-habitacion/{id}', 'TipoHabitacionController@actualizar')->name('actualizar_tipo_habitacion');
    Route::delete('tipo-habitacion/{id}', 'TipoHabitacionController@eliminar')->name('eliminar_tipo_habitacion');

    /*RUTAS DE HABITACIONES*/
    Route::get('habitacion', 'HabitacionController@index')->name('habitacion');
    Route::get('habitacion/crear', 'HabitacionController@crear')->name('crear_habitacion');
    Route::post('habitacion', 'HabitacionController@guardar')->name('guardar_habitacion');
    Route::get('habitacion/{id}/editar', 'HabitacionController@editar')->name('editar_habitacion');
    Route::put('habitacion/{id}', 'HabitacionController@actualizar')->name('actualizar_habitacion');
    Route::delete('habitacion/{id}', 'HabitacionController@eliminar')->name('eliminar_habitacion');

    /*RUTAS DE SERVICIOS*/
    Route::get('servicio', 'ServicioController@index')->name('servicio');
    Route::get('servicio/crear', 'ServicioController@crear')->name('crear_servicio');
    Route::post('servicio', 'ServicioController@guardar')->name('guardar_servicio');
    Route::get('servicio/{id}/editar', 'ServicioController@editar')->name('editar_servicio');
    Route::put('servicio/{id}', 'ServicioController@actualizar')->name('actualizar_servicio');
    Route::delete('servicio/{id}', 'ServicioController@eliminar')->name('eliminar_servicio');

    /*RUTAS DE CLIENTES*/
    Route::get('cliente', 'ClienteController@index')->name('cliente');
    Route::post('cliente/busqueda', 'ClienteController@busqueda')->name('busqueda_cliente');
    Route::get('cliente/crear', 'ClienteController@crear')->name('crear_cliente');
    Route::post('cliente', 'ClienteController@guardar')->name('guardar_cliente');
    Route::get('cliente/{id}/editar', 'ClienteController@editar')->name('editar_cliente');
    Route::put('cliente/{id}', 'ClienteController@actualizar')->name('actualizar_cliente');
    Route::delete('cliente/{id}', 'ClienteController@eliminar')->name('eliminar_cliente');

    /*RUTAS DE RESERVAS*/
    Route::get('reserva', 'ReservaController@index')->name('reserva');
    Route::post('reserva/busqueda', 'ReservaController@busqueda')->name('busqueda_reserva');
    Route::get('reserva/periodo', 'ReservaController@buscar_periodo')->name('periodo');
    Route::post('reserva/periodo', 'ReservaController@buscar_periodo')->name('buscar_periodo');
    Route::get('reserva/crear', 'ReservaController@crear')->name('crear_reserva');
    Route::post('reserva', 'ReservaController@guardar')->name('guardar_reserva');
    Route::get('reserva/{id}/editar', 'ReservaController@editar')->name('editar_reserva');
    Route::put('reserva/{id}', 'ReservaController@actualizar')->name('actualizar_reserva');
    Route::delete('reserva/{id}', 'ReservaController@eliminar')->name('eliminar_reserva');

    /*RUTAS DE GALERIA*/
    Route::get('galeria', 'GaleriaController@index')->name('galeria');
    Route::get('galeria/crear/{unitario?}', 'GaleriaController@crear')->name('crear_galeria');
    Route::post('galeria/{unitario?}', 'GaleriaController@guardar')->name('guardar_galeria');
    Route::get('galeria/{id}/editar', 'GaleriaController@editar')->name('editar_galeria');
    Route::put('galeria/actualizar/{id}', 'GaleriaController@actualizar')->name('actualizar_galeria');
    Route::delete('galeria/{id}', 'GaleriaController@eliminar')->name('eliminar_galeria');

    /*RUTA GESTOR ARCHIVOS*/
    Route::get('archivos/{id}', 'PersonalController@archivos')->name('personal_archivos');

    /*RUTAS CALENDAR*/
    Route::get('calendar/eventos', 'CalendarController@index')->name('calendar');
    Route::get('calendar/eventos/{id}', 'CalendarController@index')->name('calendar_personal');
    Route::post('calendar/eventos/add', 'CalendarController@guardar')->name('guardar_calendar');
    Route::put('calendar/eventos/{id}', 'CalendarController@actualizar')->name('actualizar_calendar');
    Route::delete('calendar/eventos/{id}', 'CalendarController@eliminar')->name('eliminar_calendar');

    Route::get('agenda/{id}', 'CalendarController@calendar')->name('agenda_personal'); //Calendario por Personal
    Route::get('calendar', 'CalendarController@calendar')->name('calendar_admin'); //Calendario completo

    /*RUTAS AJAX*/
    Route::get('ajax/select/localidades/{id}', 'GeneralController@obtener_localidades')->name('obtener_localidades');
    Route::get('ajax/select/personal', 'PersonalController@obtener_personal')->name('obtener_personal');
    Route::get('ajax/select/usuario', 'Admin\UsuarioController@obtener_usuario')->name('obtener_usuario');

    /*RUTAS ESPACIO EN DISCO*/
    Route::get('espacio/{disk}/{directorio}', 'GeneralController@space_disk')->name('obtener_espacio');
    Route::get('espacio/{disk}', 'GeneralController@space_disk')->name('obtener_espacio_disk');

});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth']], function () { // 'superadmin'

    //Route::get('', 'AdminController@index');

    /*RUTAS DE EMPRESA*/
    Route::get('empresa/{id}/editar', 'EmpresaController@editar')->name('editar_empresa');
    Route::put('empresa/{id}', 'EmpresaController@actualizar')->name('actualizar_empresa');

    /*RUTAS DE APARIENCIA INTRANET*/
    Route::get('apariencia', 'AparienciaIntranetController@index')->name('editar_apariencia');
    Route::put('apariencia', 'AparienciaIntranetController@actualizar')->name('actualizar_apariencia');

    /*RUTAS DE USUARIO*/
    Route::get('usuario', 'UsuarioController@index')->name('usuario');
    Route::get('usuario/crear', 'UsuarioController@crear')->name('crear_usuario');
    Route::post('usuario', 'UsuarioController@guardar')->name('guardar_usuario');
    Route::get('usuario/{id}/editar', 'UsuarioController@editar')->name('editar_usuario');
    Route::put('usuario/{id}', 'UsuarioController@actualizar')->name('actualizar_usuario');
    Route::delete('usuario/{id}', 'UsuarioController@eliminar')->name('eliminar_usuario');

    /*RUTAS DE PERMISO*/
    Route::get('permiso', 'PermisoController@index')->name('permiso');
    Route::get('permiso/crear', 'PermisoController@crear')->name('crear_permiso');
    Route::post('permiso', 'PermisoController@guardar')->name('guardar_permiso');
    Route::get('permiso/{id}/editar', 'PermisoController@editar')->name('editar_permiso');
    Route::put('permiso/{id}', 'PermisoController@actualizar')->name('actualizar_permiso');
    Route::delete('permiso/{id}', 'PermisoController@eliminar')->name('eliminar_permiso');

    /*RUTAS DEL MENU*/
    Route::get('menu', 'MenuController@index')->name('menu');
    Route::get('menu/crear', 'MenuController@crear')->name('crear_menu');
    Route::post('menu', 'MenuController@guardar')->name('guardar_menu');
    Route::get('menu/{id}/editar', 'MenuController@editar')->name('editar_menu');
    Route::put('menu/{id}', 'MenuController@actualizar')->name('actualizar_menu');
    Route::get('menu/{id}/eliminar', 'MenuController@eliminar')->name('eliminar_menu');
    Route::post('menu/guardar-orden', 'MenuController@guardarOrden')->name('guardar_orden');

    /*RUTAS ROL*/
    Route::get('rol', 'RolController@index')->name('rol');
    Route::get('rol/crear', 'RolController@crear')->name('crear_rol');
    Route::post('rol', 'RolController@guardar')->name('guardar_rol');
    Route::get('rol/{id}/editar', 'RolController@editar')->name('editar_rol');
    Route::put('rol/{id}', 'RolController@actualizar')->name('actualizar_rol');
    Route::delete('rol/{id}', 'RolController@eliminar')->name('eliminar_rol');

    /*RUTAS MENU_ROL*/
    Route::get('menu-rol', 'MenuRolController@index')->name('menu_rol');
    Route::post('menu-rol', 'MenuRolController@guardar')->name('guardar_menu_rol');

    /*RUTAS PERMISO_ROL*/
    Route::get('permiso-rol', 'PermisoRolController@index')->name('permiso_rol');
    Route::post('permiso-rol', 'PermisoRolController@guardar')->name('guardar_permiso_rol');

    /*RUTA GESTOR ARCHIVOS*/
    Route::get('archivos', 'AdminController@archivos')->name('archivos_admin');

    /*RUTAS PAISES*/
    Route::get('pais', 'PaisesController@index')->name('pais');
    Route::get('pais/crear', 'PaisesController@crear')->name('crear_pais');
    Route::post('pais', 'PaisesController@guardar')->name('guardar_pais');
    Route::get('pais/{id}/editar', 'PaisesController@editar')->name('editar_pais');
    Route::put('pais/{id}', 'PaisesController@actualizar')->name('actualizar_pais');
    Route::delete('pais/{id}', 'PaisesController@eliminar')->name('eliminar_pais');

    /*RUTAS PROVINCIAS*/
    Route::get('provincia', 'ProvinciaController@index')->name('provincia');
    Route::get('provincia/crear', 'ProvinciaController@crear')->name('crear_provincia');
    Route::post('provincia', 'ProvinciaController@guardar')->name('guardar_provincia');
    Route::get('provincia/{id}/editar', 'ProvinciaController@editar')->name('editar_provincia');
    Route::put('provincia/{id}', 'ProvinciaController@actualizar')->name('actualizar_provincia');
    Route::delete('provincia/{id}', 'ProvinciaController@eliminar')->name('eliminar_provincia');

    /*RUTAS POBLACIONES*/
    Route::get('poblacion', 'PoblacionController@index')->name('poblacion');
    Route::post('poblacion/busqueda', 'PoblacionController@busqueda')->name('busqueda_poblacion');
    Route::get('poblacion/crear', 'PoblacionController@crear')->name('crear_poblacion');
    Route::post('poblacion', 'PoblacionController@guardar')->name('guardar_poblacion');
    Route::get('poblacion/{id}/editar', 'PoblacionController@editar')->name('editar_poblacion');
    Route::put('poblacion/{id}', 'PoblacionController@actualizar')->name('actualizar_poblacion');
    Route::delete('poblacion/{id}', 'PoblacionController@eliminar')->name('eliminar_poblacion');
});
