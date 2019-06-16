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

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Page authentification (registration, login, logout, password_reset, etc)
// Confirmation du compte par mail: ['verify' => true]
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');

// Redirection au formulaire d'ajout d'annonce
Route::get('/ajouter-une-annonce', 'AdsController@create')->name('create_ads');
// Formulaire qui envoie les données en post à la méthode store sur la même page
Route::post('/ajouter-une-annonce', 'AdsController@store');


// Route liste des annonces
Route::get('/liste-des-annonces', 'AdsController@index')->name('list_ads');
// Formulaire qui envoie les données en post à la méthode search sur la même page
Route::post('/liste-des-annonces', 'AdsController@search');
