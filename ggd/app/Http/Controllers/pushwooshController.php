<?php

namespace App\Http\Controllers;

use App\Libraries\Pushwoosh;
use DB;


class pushwooshController extends Controller 
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    // test function 
    public function push()
    {
       // get all users    
       $users = \App\appusers::all();
        
        $pushwoosh = new Pushwoosh();
    try {
      $msg = "Test 123";
       $pushwoosh->sendMessage($msg, $users->pluck('phoneid'));
      
    } catch (Exception $ex) {
      // Doe iets met exception
        
        //echo $ex;
        console.log($ex);
        
    }
   
    }
}
