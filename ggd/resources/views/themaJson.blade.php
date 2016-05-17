 @foreach ($themas as $row)
<?php 

        $json[]=array(
            'id'=>$row['id'],
           'favorite'=>$row['favorite'],
           'titel'=>$row['titel'],
           'info'=>$row['info'],
           'email'=>$row['email'],
           'phone'=>$row['phone'],
           'photo'=>$row['photo'],

           
       ); 

   
?>
     @endforeach
<?php
echo json_encode(array( 'information'  =>  $json ),JSON_UNESCAPED_SLASHES);

?> 