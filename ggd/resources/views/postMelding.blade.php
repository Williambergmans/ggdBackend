<?php

if(DB::connection()->getDatabaseName())
{
   echo "Connected sucessfully to database ".DB::connection()->getDatabaseName().".";
}
?>
  <form action="{{action('jsonController@save')}}" method="post"> 
                           <input type="hidden" name="id" value="<?= $row->id ?>">
                           
                           <?php
                           
$titel = isset($_POST['titel']) ? $_POST["titel"] : "";
$datum = isset($_POST['datum']) ? $_POST["datum"] : "";
$categorie = isset($_POST['categorie']) ? $_POST["categorie"] : "";
$inhoud = isset($_POST['inhoud']) ? $_POST["inhoud"] : "";
$longitude = isset($_POST['longitude']) ? $_POST["longitude"] : "";
$latitude = isset($_POST['latitude']) ? $_POST["latitude"] : "";

                           ?>
                           
                           
                           
           
            <input type="hidden" class="form-control" class="form-control" name="_token" value="{{ csrf_token() }}">
            <input type="submit"  class="btn btn-primary" value="Save">
        </form> 


?> 