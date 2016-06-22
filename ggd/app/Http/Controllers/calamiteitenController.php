<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use DB;
Use App\Libraries\Pushwoosh;
use Carbon;

class calamiteitenController extends Controller {

    // check if user is admin
    public function __construct() {
        $this->middleware('isAdmin');
    }

    // delete calamiteit by id
    public function delete($id) {
        $i = DB::table('calamiteiten')->where('id', $id)->delete();
        if ($i > 0) {
            return redirect('calamiteiten');
        }
    }

    // show edit calamiteit page by id
    public function edit($id) {
        $row = DB::table('calamiteiten')->where('id', $id)->first();
        return view('editCalamiteit')->with('row', $row);
    }

    // update calamiteit function
    public function updateCal() {
        $id = Input::get('id');
        $titleName = Input::get('titleName');
        $omschrijvingName = Input::get('omschrijvingName');
        $categorieName = Input::get('categorieName');
        $locatieName = Input::get('locatieName');
        $maandName = Input::get('maandName');
        $dagName = Input::get('dagName');
        $dagGetalName = Input::get('dagGetalName');
        $startName = Input::get('startName');
        $eindName = Input::get('eindName');
        $emailName = Input::get('emailName');
        $phoneName = Input::get('phoneName');
        $inhoudName = Input::get('inhoudName');
        $latitudeName = Input::get('latitudeName');
        $longitudeName = Input::get('longitudeName');
        $photoName = Input::get('photoName');
        $templateName = Input::get('templateName');
        $data = array(
            'id' => $id,
            'calamiteitTitel' => $titleName,
            'omschrijving' => $omschrijvingName,
            'categorie' => $categorieName,
            'locatie' => $locatieName,
            'maand' => $maandName,
            'dag' => $dagName,
            'dagGetal' => $dagGetalName,
            'start' => $startName,
            'eind' => $eindName,
            'email' => $emailName,
            'phone' => $phoneName,
            'about' => $inhoudName,
            'latitude' => $latitudeName,
            'longitude' => $longitudeName,
            'photo' => $photoName,
            'template' => $templateName,
            'updated_at' => Carbon\Carbon::now(),
        );

        // function that calculates the distance between two locations
        function getDistance($latitude1, $longitude1, $latitude2, $longitude2) {
            $earth_radius = 6371;

            $dLat = deg2rad($latitude2 - $latitude1);
            $dLon = deg2rad($longitude2 - $longitude1);

            $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon / 2) * sin($dLon / 2);
            $c = 2 * asin(sqrt($a));
            $d = $earth_radius * $c;

            return $d;
        }

        // save edited data to database
        $i = DB::table('calamiteiten')->where('id', $id)->update($data);
        // if saved
        if ($i > 0) {
            // get all userdata from model
            $user = \App\appusers::all();

            // loop through userdata
            for ($a = 0; $a < count($user); $a++) {

                // loop through location data
                $lat1 = $user[$a]->userlat;
                $long1 = $user[$a]->userlong;

                //echo $lat1;
                //echo $long1;
                // calculate distance between user location and calamiteit location 
                // $distance in meters
                $distance = getDistance($lat1, $long1, $latitudeName, $longitudeName) * 1000;

                // if distance is smaller than distance setting of user, send an notification
                if ($distance < $user[$a]->distance) {

                    $device_id = $user[$a]->phoneid; 

                    $pushwoosh = new Pushwoosh();
                    try {
                         // check template 
                        if ($templateName == "calamiteitTemplate") {

                            $msg = "Update: " . $titleName;
                        } else {
                            $msg = "Vragenlijst: " . $titleName;
                        }
                        // verzend notificatie
                        $pushwoosh->sendMessage($msg, $device_id);
                    } catch (Exception $ex) {
                        // Doe iets met exception
                        //echo $ex;
                        console . log($ex);
                    }
                }
            }
            // return to calamiteiten page
            return redirect('calamiteiten');
        }
    }

    public function calamiteiten() {

        $calamiteiten = \App\calamiteiten::where('template', '=', "calamiteitTemplate")->get();
        return view('calamiteiten', array('calamiteiten' => $calamiteiten));
    }

}
