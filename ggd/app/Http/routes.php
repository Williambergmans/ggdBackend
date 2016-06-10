<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'web'], function () {
    
    
Route::auth();

Route::get('access', function(){
            
            echo 'You have access';
            
        })->middleware('isAdmin');

          Route::get('access', function(){
            
            echo 'You have access';
            
        })->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});

exec('composer dump-autoload');

Route::get('/home', 'HomeController@index');

Route::get('calamiteiten', 'calamiteitenController@calamiteiten'); 
Route::get('DeleteCalamiteit/{id}', 'calamiteitenController@delete');
Route::get('EditCalamiteit/{id}', 'calamiteitenController@edit');
Route::post('updateCal', 'calamiteitenController@updateCal');
Route::get('toevoegencalamiteit', 'addCalamiteitController@addCalamiteit');
Route::post('toevoegencalamiteit', 'addCalamiteitController@save');

Route::post('toevoegenvragenlijst/{id}', 'vragenlijstController@save');
Route::get('toevoegenvragenlijst/{id}', 'vragenlijstController@add');
Route::get('vragenlijsten', 'vragenlijstController@vragenlijsten');
Route::get('editVragenlijst/{id}', 'vragenlijstController@editLijst');
Route::post('updateLijst', 'vragenlijstController@updateLijst');
Route::get('deleteLijst/{id}', 'vragenlijstController@deleteLijst');
Route::post('updateVraag', 'vragenlijstController@updateVraag');
Route::get('nieuwvragenlijst', 'vragenlijstController@addVragenlijst');
Route::post('nieuwvragenlijst', 'vragenlijstController@saveNieuw');



Route::get('meldingen', 'meldingenController@meldingen');
Route::get('DeleteMelding/{id}','meldingenController@delete');

Route::get('informatie', 'informatieController@informatie');
Route::get('DeleteInformatie/{id}', 'informatieController@delete');
Route::get('EditInformatie/{id}', 'informatieController@edit');
Route::post('updateInfo', 'informatieController@update');
Route::get('toevoegeninformatie', 'addInformatieController@addInformatie');
Route::post('toevoegeninformatie', 'addInformatieController@save');

Route::get('themas', 'themaController@thema');
Route::get('EditThema/{id}', 'themaController@edit');
Route::post('updateTheme', 'themaController@update');

Route::get('calamiteitenJson', 'jsonController@calamiteiten');

Route::get('themaJson', 'jsonController@themas');

Route::get('informatieJson', 'jsonController@informatie');
Route::post('postMelding', 'jsonController@save');
//Route::get('postMelding', 'jsonController@save'); 
Route::post('postVragenlijst', 'jsonController@saveVragenlijst');
//Route::get('postVragenlijst', 'jsonController@saveVragenlijst');
 
Route::get('vragenlijst', 'vragenlijstController@vragenlijst');
Route::get('DeleteVragenlijst/{id}', 'vragenlijstController@delete');

Route::get('test', 'pushwooshController@push');

// opslaan van device id 
Route::post('postUserData', 'jsonController@saveUserdata');
Route::post('updateUserData', 'jsonController@updateUserdata');
Route::get('updateUserData', 'jsonController@updateUserdata');
//çRoute::get('postUserData', 'jsonController@saveUserdata');
  
});

 


