<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use App\addInfo;



class addInformatieController extends Controller
{
    // check if user is admin
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    // function that returns an view
    public function addInformatie()
    {
      return view('toevoegeninformatie');
       
    }
        // save new information
    public function save()
    {
         $titleName=Input::get('titleName');
         $infoName=Input::get('infoName');
         $photoName=Input::get('photoName');
         $emailName=Input::get('emailName');
         $phoneName=Input::get('phoneName');
         
    $data=array(
         'titel'=>$titleName,
         'info'=>$infoName,
         'photo'=>$photoName,
         'email'=>$emailName,
         'phone'=>$phoneName,
        );
        // save informatie to database
        $response=addInfo::create($data);
        // if data is send
        if($response)
        {
            // retuen to information page
            return redirect('informatie');
                 
        }
  }
}
