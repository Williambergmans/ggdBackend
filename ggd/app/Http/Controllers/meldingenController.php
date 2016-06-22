<?php

namespace App\Http\Controllers;

use DB;

class meldingenController extends Controller
{
      // check if user is admin
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    // function that returns an view
     public function meldingen(){
         
         $meldingen = \App\meldingen::all();
         return view('meldingen', array('meldingen' => $meldingen));
     }
     
     
       // show melding details
       public function details($id)
     {
         $row = DB::table('meldingen')->where('id',$id)->first();
             return view('meldingDetails')->with('row', $row);
     }

     
       // delete melding by id
       public function delete($id)
     {
         $i = DB::table('meldingen')->where('id',$id)->delete();
         if ($i > 0 )
     {
         return redirect('meldingen');
     }         
     }
     
     
} 
