<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Support\Facades\Input;
use App\addCal;
use Carbon;
Use App\Libraries\Pushwoosh;

class vragenlijstController extends Controller {

    // check if user is admin
    public function __construct() {
        $this->middleware('isAdmin');
    }

    // function that returns a view with send vragenlijst data form users
    public function vragenlijst() {

        $vragenlijst = \App\vragenlijst::all();
        return view('vragenlijst', array('vragenlijst' => $vragenlijst));
    }

    // function that returns a view with vragenlijst data
    public function addVragenlijst() {
        return view('nieuwvragenlijst');
    }

    // function that returns a view with vragenlijsten that are send by GGD 
    public function vragenlijsten() {

        $calamiteiten = \App\calamiteiten::where('template', '=', "vragenlijstTemplate")->get();
        return view('vragenlijsten', array('calamiteiten' => $calamiteiten));
    }

    // delele vragenlijst that is send by GGD by id
    public function deleteLijst($id) {
        $i = DB::table('calamiteiten')->where('id', $id)->delete();
        if ($i > 0) {
            return redirect('vragenlijsten');
        }
    }

// edit vragenlijst that is send by GGD by id
    public function editLijst($id) {
        $row = DB::table('calamiteiten')->where('id', $id)->first();
        return view('editVragenlijst')->with('row', $row);
    }

    // delele vragenlijst that is send by user
    public function delete($id) {
        $i = DB::table('vragenlijst')->where('id', $id)->delete();
        if ($i > 0) {
            return redirect('vragenlijst');
        }
    }

    // add new vragenlijst 
    public function add($id) {
        $row = DB::table('calamiteiten')->where('id', $id)->first();
        return view('toevoegenvragenlijst')->with('row', $row);
    }

    // save vragenlijst from calamiteit
    public function save() {
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
        $vraag1Name = Input::get('vraag1Name');
        $vraag2Name = Input::get('vraag2Name');
        $vraag3Name = Input::get('vraag3Name');
        $vraag4Name = Input::get('vraag4Name');
        $vraag5Name = Input::get('vraag5Name');
        $templateName = Input::get('templateName');
        $data = array(
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
            'vraag1Titel' => $vraag1Name,
            'vraag2Titel' => $vraag2Name,
            'vraag3Titel' => $vraag3Name,
            'vraag4Titel' => $vraag4Name,
            'vraag5Titel' => $vraag5Name,
            'template' => $templateName,
        );
        // data is send to database
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


                $lat1 = $user[$a]->userlat;
                $long1 = $user[$a]->userlong;

                echo $lat1;
                echo $long1;

                // calculate distance between user location and calamiteit location 
                // $distance in meters
                $distance = getDistance($lat1, $long1, $latitudeName, $longitudeName) * 1000;

                // if distance is smaller than distance setting of user, send an notification
                if ($distance < $user[$a]->distance) {

                    $device_id = $user[$a]->phoneid;

                    $pushwoosh = new Pushwoosh();
                    try {

                        $msg = "Vragenlijst: " . $titleName;

                        $pushwoosh->sendMessage($msg, $device_id);
                    } catch (Exception $ex) {
                        // Doe iets met exception
                        //echo $ex;
                        console . log($ex);
                    }
                }
            }



            return redirect('vragenlijsten');
        }
    }

    // save new vragenlijst without a calamiteit
    public function saveNieuw() {
        $titleName = Input::get('titleName');
        $locatieName = Input::get('locatieName');
        $maandName = Input::get('maandName');
        $dagName = Input::get('dagName');
        $dagGetalName = Input::get('dagGetalName');
        $latitudeName = Input::get('latitudeName');
        $longitudeName = Input::get('longitudeName');
        $photoName = Input::get('photoName');
        $vraag1Name = Input::get('vraag1Name');
        $vraag2Name = Input::get('vraag2Name');
        $vraag3Name = Input::get('vraag3Name');
        $vraag4Name = Input::get('vraag4Name');
        $vraag5Name = Input::get('vraag5Name');
        $templateName = Input::get('templateName');
        $data = array(
            'calamiteitTitel' => $titleName,
            'locatie' => $locatieName,
            'maand' => $maandName,
            'dag' => $dagName,
            'dagGetal' => $dagGetalName,
            'latitude' => $latitudeName,
            'longitude' => $longitudeName,
            'photo' => $photoName,
            'vraag1Titel' => $vraag1Name,
            'vraag2Titel' => $vraag2Name,
            'vraag3Titel' => $vraag3Name,
            'vraag4Titel' => $vraag4Name,
            'vraag5Titel' => $vraag5Name,
            'template' => $templateName,
        );
        // if data is send
        $response = addCal::create($data);

        // function that calculates the distance between two locations
        function getDistance($latitude1, $longitude1, $latitude2, $longitude2) {
            $earth_radius = 6371;

            $dLat = deg2rad($latitude2 - $latitude1);
            $dLon = deg2rad($longitude2 - $longitude1);

            $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon / 2) * sin($dLon / 2);
            $c = 2 * asin(sqrt($a));
            $d = $earth_radius * $c;
            // distance in km
            return $d;
        }

        // if data is send
        if ($response) {
            // get user data from database
            $user = \App\appusers::all();

            // loop through userdata
            for ($a = 0; $a < count($user); $a++) {


                $lat1 = $user[$a]->userlat;
                $long1 = $user[$a]->userlong;


                // calculate distance between user location and calamiteit location 
                // $distance in meters
                $distance = getDistance($lat1, $long1, $latitudeName, $longitudeName) * 1000;


                // if distance is smaller than distance setting of user, send an notification
                if ($distance < $user[$a]->distance) {

                    $device_id = $user[$a]->phoneid;

                    $pushwoosh = new Pushwoosh();
                    try {

                        $msg = "Vragenlijst: " . $titleName;

                        $pushwoosh->sendMessage($msg, $device_id);
                    } catch (Exception $ex) {
                        // Doe iets met exception
                        //echo $ex;
                        console . log($ex);
                    }
                }
            }



            return redirect('vragenlijsten');
        }
    }

    // update vragenlijst
    public function updateVraag() {
        $id = Input::get('id');
        $titleName = Input::get('titleName');
        $locatieName = Input::get('locatieName');
        $photoName = Input::get('photoName');
        $latitudeName = Input::get('latitudeName');
        $longitudeName = Input::get('longitudeName');
        $vraag1Name = Input::get('vraag1Name');
        $vraag2Name = Input::get('vraag2Name');
        $vraag3Name = Input::get('vraag3Name');
        $vraag4Name = Input::get('vraag4Name');
        $vraag5Name = Input::get('vraag5Name');

        $data = array(
            'id' => $id,
            'calamiteitTitel' => $titleName,
            'locatie' => $locatieName,
            'photo' => $photoName,
            'latitude' => $latitudeName,
            'longitude' => $longitudeName,
            'vraag1Titel' => $vraag1Name,
            'vraag2Titel' => $vraag2Name,
            'vraag3Titel' => $vraag3Name,
            'vraag4Titel' => $vraag4Name,
            'vraag5Titel' => $vraag5Name,
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
            // distance in km
            return $d;
        }

        // send all data to database
        $i = DB::table('calamiteiten')->where('id', $id)->update($data);
        // if data is send
        if ($i > 0) {
            // get all user data
            $user = \App\appusers::all();

            // loop through userdata
            for ($a = 0; $a < count($user); $a++) {


                $lat1 = $user[$a]->userlat;
                $long1 = $user[$a]->userlong;



                // calculate distance between user location and calamiteit location 
                // $distance in meters
                $distance = getDistance($lat1, $long1, $latitudeName, $longitudeName) * 1000;


                // if distance is smaller than distance setting of user, send an notification
                if ($distance < $user[$a]->distance) {

                    $device_id = $user[$a]->phoneid;

                    $pushwoosh = new Pushwoosh();
                    try {

                        $msg = "Vragenlijst update: " . $titleName;

                        $pushwoosh->sendMessage($msg, $device_id);
                    } catch (Exception $ex) {
                        // Doe iets met exception
                        //echo $ex;
                        console . log($ex);
                    }
                }
            }



            return redirect('vragenlijsten');
        }
    }

}
