<?php

namespace App\Http\Controllers;


use DB;

class vragenlijstController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    
     public function vragenlijst(){
         
         $vragenlijst = \App\vragenlijst::all();
         return view('vragenlijst', array('vragenlijst' => $vragenlijst));
     }
     
     
       public function delete($id)
     {
         $i = DB::table('vragenlijst')->where('id',$id)->delete();
         if ($i > 0 )
     {
         return redirect('vragenlijst');
     }         
     }
     
     
}
