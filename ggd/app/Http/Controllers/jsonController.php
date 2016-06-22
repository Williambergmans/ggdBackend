<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;

class jsonController extends Controller {

    // return calamiteiten api ordered by date "updated_at"
    public function calamiteiten() {

        $calamiteiten = \App\calamiteiten::orderBy('updated_at', 'desc')->get();

        return view('calamiteitenJson', array('calamiteiten' => $calamiteiten));
    }

    // return thema api
    public function themas() {

        $themas = \App\themas::all();
        return view('themaJson', array('themas' => $themas));
    }

    // return informatie api
    public function informatie() {

        $informatie = \App\informatie::orderBy('titel', 'asc')->get();
        // $calamiteiten = \App\calamiteiten::orderBy('updated_at','desc' )->get();
        return view('informatieJson', array('informatie' => $informatie));
    }

    // save melding form app user
    public function save() {

        $meldingen = new \App\meldingen;
        $meldingen->titel = Input::get('titel', false);
        $meldingen->datum = Input::get('datum', false);
        $meldingen->categorie = Input::get('categorie', false);
        $meldingen->inhoud = Input::get('inhoud', false);
        $meldingen->latitude = Input::get('latitude', false);
        $meldingen->longitude = Input::get('longitude', false);
        $meldingen->mail = Input::get('mail', false);
        $meldingen->phone = Input::get('phone', false);

        $data = array(
            'titel' => $meldingen->titel,
            'datum' => $meldingen->datum,
            'categorie' => $meldingen->categorie,
            'inhoud' => $meldingen->inhoud,
            'latitude' => $meldingen->latitude,
            'longitude' => $meldingen->longitude,
            'mail' => $meldingen->mail,
            'phone' => $meldingen->phone,
        );
        // send data to database
        $response = \App\meldingen::create($data);
        // if data is send
        if ($response) {
            // return response
            return response()->json(['Titel' => $meldingen->titel, 'datum' => $meldingen->datum, 'categorie' => $meldingen->categorie, 'inhoud' => $meldingen->inhoud, 'latitude' => $meldingen->latitude, 'longitude' => $meldingen->longitude]);
        }
    }

// save vragenlijst from app user

    public function saveVragenlijst() {

        $vragenlijst = new \App\vragenlijst;
        $vragenlijst->titel = Input::get('titel', false);
        $vragenlijst->vraag1 = Input::get('vraag1', false);
        $vragenlijst->vraag2 = Input::get('vraag2', false);
        $vragenlijst->vraag3 = Input::get('vraag3', false);
        $vragenlijst->vraag4 = Input::get('vraag4', false);
        $vragenlijst->vraag5 = Input::get('vraag5', false);
        $vragenlijst->mail = Input::get('mail', false);


        $data = array(
            'titel' => $vragenlijst->titel,
            'vraag1' => $vragenlijst->vraag1,
            'vraag2' => $vragenlijst->vraag2,
            'vraag3' => $vragenlijst->vraag3,
            'vraag4' => $vragenlijst->vraag4,
            'vraag5' => $vragenlijst->vraag5,
            'mail' => $vragenlijst->mail,
        );
        // send data to database
        $response = \App\vragenlijst::create($data);
        // if data is send
        if ($response) {
            // retrun resonse
            return response()->json(['Titel' => ' $meldingen->titel', 'datum' => '$meldingen->datum', 'categorie' => ' $meldingen->categorie', 'inhoud' => '$meldingen->inhoud', 'latitude' => '$meldingen->latitude', 'longitude' => '$meldingen->longitude']);
        }
    }

    
    //function that saves pushwoosh user id when starting the app
    public function saveUserdata() {

        // create new user
        $userdata = new \App\appusers();
        // get id
        $userdata->phoneid = Input::get('phoneid', false);
         // check with query if user excists
        $user = \App\appusers::where('phoneid', '=', $userdata->phoneid)->first();
        // if user doesn't excists 
        if ($user === null) {
       
            // get id
            $data = array(
                'phoneid' => $userdata->phoneid,
            );
            // send id to database
            $response = \App\appusers::create($data);
            // if data is send
            if ($response) {
                return response()->json(['phoneid' => $userdata->phoneid]);
            }
        }
    }
     //function that updates user data
    public function updateUserdata() {
        $userdata = new \App\appusers();
        $userdata->phoneid = Input::get('phoneid', false);
        $userdata->userlat = Input::get('userlat', false);
        $userdata->userlong = Input::get('userlong', false);
        $userdata->distance = Input::get('distance', false);

        $data = array(
            'userlat' => $userdata->userlat,
            'userlong' => $userdata->userlong,
            'distance' => $userdata->distance,
        );
          // send data to database
        $i = DB::table('appusers')->where('phoneid', $userdata->phoneid)->update($data);
        // id is send
        if ($i > 0) {
            return response()->json(['phoneid' => $userdata->phoneid]);
        }
    }

}
