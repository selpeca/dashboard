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

//PDF
Route::get('pdfProductos','ProductController@pdf')->name('pdfProductos');
Route::get('pdfLotes','ProductLotController@pdf')->name('pdfLotes');
Route::get('pdfClientes','ClientController@pdf')->name('pdfClientes');
Route::get('pdfUsuarios','UserController@pdf')->name('pdfUsuarios');

//Graficos

Route::get('gUsuariosClientes','ChartController@users_invoices')->name('gUsuariosClientes');

//Login page
Route::get('/','DashboardController@index')->name('/');

Route::get('listallProducts/{page?}', [
    'as' => 'listallProducts',
    'uses' => 'ProductController@listall'
]);

Route::get('listallProductLots/{page?}', [
    'as' => 'listallProductLots',
    'uses' => 'ProductLotController@listall'
]);

Route::get('listallClients/{page?}', [
    'as' => 'listallClients',
    'uses' => 'ClientController@listall'
]);

Route::get('listallUsers/{page?}', [
    'as' => 'listallUsers',
    'uses' => 'UserController@listall'
]);

Route::get('dashboard','DashboardController@index')->name('dashboard');
Route::resource('usuarios', 'UserController');
Route::resource('productos', 'ProductController');
Route::resource('lotes', 'ProductLotController');
Route::resource('clientes', 'ClientController');
Route::resource('vender', 'InvoiceController');


//Sesiones
Route::GET('autUsername','Auth\LoginController@autUsername')->name('autUsername');
Route::POST('login','Auth\LoginController@login')->name('login');

// Envio de correos

Route::get('sendmail/{pass?}', function ($pass) {
    $data= array('pass' => $pass );

    Mail::send('emails.welcome', $data, function ($message) {
        $message->from('seperez@uniguajira.edu.co', 'cmadmin 2.0');
        $message->to('ser.per.eli@gmail.com')->subject('Contraseña dinámica');
    });    
})->name('sendmail');

