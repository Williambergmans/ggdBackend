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

// every route in this group has to be checked for authorization
   Route::auth();


//for some pages you have to be admin 
    Route::get('access', function() {

        echo 'You have access';
    })->middleware('isAdmin');

//for some pages you have to be logged in
    Route::get('access', function() {

        echo 'You have access';
    })->middleware('auth');

    // returns welcome screen
    Route::get('/', function () {
        return view('welcome');
    });
// used to add pushwoosh script
    exec('composer dump-autoload');

// show index page
    Route::get('/home', 'HomeController@index');

// show calamiteiten page
    Route::get('calamiteiten', 'calamiteitenController@calamiteiten');
// delete calamiteit by id
    Route::get('DeleteCalamiteit/{id}', 'calamiteitenController@delete');
// edit calamiteit by id
    Route::get('EditCalamiteit/{id}', 'calamiteitenController@edit');
// update calamiteit
    Route::post('updateCal', 'calamiteitenController@updateCal');
// show toevoegencalamiteit page
    Route::get('toevoegencalamiteit', 'addCalamiteitController@addCalamiteit');
// add new calamiteit
    Route::post('toevoegencalamiteit', 'addCalamiteitController@save');

// post vragenlijst of excisting calamiteit
    Route::post('toevoegenvragenlijst/{id}', 'vragenlijstController@save');
// add vragenlijst in calamiteit page
    Route::get('toevoegenvragenlijst/{id}', 'vragenlijstController@add');
// show all send vragenlijsten
    Route::get('vragenlijsten', 'vragenlijstController@vragenlijsten');
// show edit vragenlijst page
    Route::get('editVragenlijst/{id}', 'vragenlijstController@editLijst');
// Update vragenlijst
    Route::post('updateLijst', 'vragenlijstController@updateLijst');
// delete vragenlijst
    Route::get('deleteLijst/{id}', 'vragenlijstController@deleteLijst');
// post Updated vragenlijst
    Route::post('updateVraag', 'vragenlijstController@updateVraag');
// show add new vragenlijst page
    Route::get('nieuwvragenlijst', 'vragenlijstController@addVragenlijst');
// post new vragenlijst
    Route::post('nieuwvragenlijst', 'vragenlijstController@saveNieuw');


// show meldingen from app users page
    Route::get('meldingen', 'meldingenController@meldingen');
// show meldingen details page
    Route::get('meldingDetails/{id}', 'meldingenController@details');  
// delete meldingen from users
    Route::get('DeleteMelding/{id}', 'meldingenController@delete');
// show informatie page
    Route::get('informatie', 'informatieController@informatie');
// delete informatie by id
    Route::get('DeleteInformatie/{id}', 'informatieController@delete');
// show edit informatie page by id
    Route::get('EditInformatie/{id}', 'informatieController@edit');
// update information
    Route::post('updateInfo', 'informatieController@update');
// show add informatie page
    Route::get('toevoegeninformatie', 'addInformatieController@addInformatie');
// post new informatie
    Route::post('toevoegeninformatie', 'addInformatieController@save');

// show thema page
    Route::get('themas', 'themaController@thema');
// show edit thema by id page
    Route::get('EditThema/{id}', 'themaController@edit');
// update theme data
    Route::post('updateTheme', 'themaController@update');
// show calamiteiten api
    Route::get('calamiteitenJson', 'jsonController@calamiteiten');
// show thema api
    Route::get('themaJson', 'jsonController@themas');
// show informatie api
    Route::get('informatieJson', 'jsonController@informatie');


// post melding in app
    Route::post('postMelding', 'jsonController@save');

// post vragenlijst in app
    Route::post('postVragenlijst', 'jsonController@saveVragenlijst');

// show vragenlijst page
    Route::get('vragenlijst', 'vragenlijstController@vragenlijst');
// delete vragenlijst by id
    Route::get('DeleteVragenlijst/{id}', 'vragenlijstController@delete');
// sends notification test
//Route::get('test', 'pushwooshController@push');
// post  device id 
    Route::post('postUserData', 'jsonController@saveUserdata');
// post location and distance setting of user
    Route::post('updateUserData', 'jsonController@updateUserdata');

//Route::get('updateUserData', 'jsonController@updateUserdata');
//çRoute::get('postUserData', 'jsonController@saveUserdata');
});




