<?php

// Autenticação
Route::prefix('auth')->group(function () {
    Route::post('login',   'AuthController@login');    // POST /api/auth/login
    Route::post('logout',  'AuthController@logout');   // POST /api/auth/logout
    Route::post('refresh', 'AuthController@refresh');  // POST /api/auth/refresh
    Route::get('me',       'AuthController@me');       // GET  /api/auth/me
});

Route::middleware('auth:api')->group(function () {

    // Filmes 
    Route::get   ('filmes',       'FilmeController@index');    // GET    /api/filmes
    Route::post  ('filmes',       'FilmeController@store');    // POST   /api/filmes
    Route::get   ('filmes/{id}',  'FilmeController@show');     // GET    /api/filmes/{id}
    Route::put   ('filmes/{id}',  'FilmeController@update');   // PUT    /api/filmes/{id}
    Route::delete('filmes/{id}',  'FilmeController@destroy');  // DELETE /api/filmes/{id}

    // Categorias
    Route::get   ('categorias',       'CategoriaController@index');   // GET    /api/categorias
    Route::post  ('categorias',       'CategoriaController@store');   // POST   /api/categorias
    Route::get   ('categorias/{id}',  'CategoriaController@show');    // GET    /api/categorias/{id}
    Route::put   ('categorias/{id}',  'CategoriaController@update');  // PUT    /api/categorias/{id}
    Route::delete('categorias/{id}',  'CategoriaController@destroy'); // DELETE /api/categorias/{id}
});