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

/*
Route::get('/', function () {
    return view('welcome');
}); */



Route::get('tabletest', 'HomeController@indeksas')->name('indeksas');

Route::get('/home', 'HomeController@roles')->name('roles');
Route::get('/home', 'HomeController@skyriuRodymas')->name('skyriai');

Route::get('/db', 'DbController@index')->name('db');

//Route::get('generate-pdf','HomeController@generatePDF');

// Route::get('/db','DbController@generatePDF');
Route::get('/customers/pdf','DbController@export_pdf');
Route::get('export', 'ExportController@export')->name('export');
Route::get('exportas', 'ExportController@exportas')->name('exportas');


Route::get('export_PDF', 'PdfController@export_pdf')->name('export_pdf');
Route::get('generate-pdf', 'PdfController@pdfview')->name('generate-pdf');

Route::post('Copytodb', 'RecordsController@Copytodb')->name('Copytodb');
Route::patch('Copytodb2/{id}', 'RecordsController@Copytodb2')->name('Copytodb2');

// Route::get('/db', 'DbController@roles')->name('db');
//Route::get('/db', 'DbController@skyriuRodymas')->name('db');

 Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('nukreipymas/{id}', 'RecordsController@nukreipymas')->name('nukreipymas');
Route::get('nukreipymas2/{id}', 'RecordsController@nukreipymas2')->name('nukreipymas2');
Route::delete('nukreipymasdelete/{id}', 'RecordsController@nukreipymasdelete')->name('nukreipymasdelete');

 Auth::routes();

Route::get('/admin/routes', 'HomeController@admin')->middleware('admin');









Route::get('/', function () {
    return view('welcome');
});


Route::get('/VartotojasSkyrius', 'VartotojasSkyriusController@Vartotojas')->name('vart');



 Route::resource('Vartotojas', 'VartotojasController')->middleware('admin');
Route::resource('Skyriai', 'SkyriaiController')->middleware('admin');
Route::resource('VartotojasSkyrius', 'VartotojasSkyriusController')->middleware('admin');
//////////////////
