 @foreach ($calamiteiten as $row)
<?php 

       $json[]=array(
           'id'=>(string)$row['id'],
           'favorite'=>$row['favorite'],
           'calamiteitTitel'=>$row['calamiteitTitel'],
           'omschrijving'=>$row['omschrijving'],
           'categorie'=>$row['categorie'],
           'locatie'=>$row['locatie'],
           'maand'=>$row['maand'],
           'dag'=>$row['dag'],
           'dagGetal'=>$row['dagGetal'],
           'start'=>$row['start'],
           'eind'=>$row['eind'],
           'email'=>$row['email'],
           'phone'=>$row['phone'],
           'about'=>$row['about'],
           'latitude'=>$row['latitude'],
           'longitude'=>$row['longitude'],
           'photo'=>$row['photo'],
           'vraag1Titel'=>$row['vraag1Titel'],
           'vraag2Titel'=>$row['vraag2Titel'],
           'vraag3Titel'=>$row['vraag3Titel'],
           'vraag4Titel'=>$row['vraag4Titel'],
           'vraag5Titel'=>$row['vraag5Titel'],
           'template'=>$row['template'],

           
           
       );
   
?>
     @endforeach
<?php
echo json_encode(array( 'calamiteiten'  =>   $json ),JSON_UNESCAPED_SLASHES);

?>