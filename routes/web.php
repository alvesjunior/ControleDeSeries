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


Route::get('/', 'SeriesController@index');
// ->middleware('auth');
Route::get('/series', 'SeriesController@index')
    ->name('listar_series');
Route::get('/series/create', 'SeriesController@create')
    ->name('form_criar_serie');
Route::post('/series/create', 'SeriesController@store');
Route::delete('/series/remove/{id}', 'SeriesController@destroy');
Route::post('/series/{id}/editarNome', 'SeriesController@editarNome');

Route::get('/series/{serieId}/temporadas', 'TemporadasController@index');
Route::get('/temporadas/{temporada}/episodios', 'EpisodiosController@index');
Route::post('/temporadas/{temporada}/episodios/assistir', 'EpisodiosController@assistir');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/entrar', 'EntrarController@index')
->name('entrar');
Route::post('/entrar', 'EntrarController@entrar');
Route::get('/registrar', 'RegistroController@create')->name('registrar');
Route::post('/registrar', 'RegistroController@store');
Route::get('/trocar', 'RegistroController@UpdateCampo');
Route::get('/sair', function () {
    \Illuminate\Support\Facades\Auth::logout();
    redirect('/entrar');
});

Route::get('/visualiza-serie', function () {
    return new \App\Mail\NovaSerie(
        'nome',
        '15',
        '3'
    );
});

Route::get('/enviando-email', function () {
    $email = new \App\Mail\NovaSerie(
        'nome',
        '15',
        '3'
    );
    $email->subject = 'Nova série Adicionada';
    $user = (object)[
        'email' => 'flavio.augusto@brwo.com.br',
        'name' => 'Diego'
    ];
    \Illuminate\Support\Facades\Mail::to($user)->send($email);;
    return 'email enviado';
});
