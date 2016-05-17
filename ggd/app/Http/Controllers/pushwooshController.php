<?php

namespace App\Http\Controllers;

use App\Libraries\Pushwoosh;


class pushwooshController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    

    public function push()
    {
           $device_id = "AD176F1E-AE7C-49DA-B78F-27B8E187D5A8";
          //$device_id = "B2666CF17D68AEAF";
   
        $pushwoosh = new Pushwoosh();
    try {
      $msg = "Test 123";
      $pushwoosh->sendMessage($msg, array($device_id));
    } catch (Exception $ex) {
      // Doe iets met exception
        
        //echo $ex;
        console.log($ex);
    }
       
    }
}
