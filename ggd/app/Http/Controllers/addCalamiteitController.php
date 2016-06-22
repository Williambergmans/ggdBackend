<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\addCal;
use DB;
Use App\Libraries\Pushwoosh;

class addCalamiteitController extends Controller {

    // check if user is admin
    public function __construct() {
        $this->middleware('isAdmin');
    }

    // function that returns an view
    public function addCalamiteit() {
        return view('toevoegencalamiteit');
    }

    // save new calamiteit
    public function save() {
        $titleName = Input::get('titleName');
        $omschrijvingName = Input::get('omschrijvingName');
        $categorieName = Input::get('categorieName');
        $locatieName = Input::get('locatieName');
        $adresName = Input::get('adresName');
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
            'calamiteitTitel' => $titleName,
            'omschrijving' => $omschrijvingName,
            'categorie' => $categorieName,
            'locatie' => $locatieName,
            'adres' => $adresName,
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
        );
        // send data to database
        $response = addCal::create($data);

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
        // if data is send
        if ($response) { 

            // get all userdata
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

                        $msg = "Melding: " . $titleName;

                        $pushwoosh->sendMessage($msg, $device_id);
                    } catch (Exception $ex) {
                        // Doe iets met exception
                        //echo $ex;
                        console . log($ex);
                    }
                }
            }

            //return to calamiteiten page
            return redirect('calamiteiten');
        }
    }

}
