@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Voeg een calamiteit toe</div>
                <div class="panel-body">
                   
                    <form action="{{action('calamiteitenController@updateCal')}}" method="post"> 
                           <input type="hidden" name="id" value="<?= $row->id ?>">
                             <div class="form-group">
                            <label for="exampleInputName1">Titel van calamiteit</label>
            <input type="text" class="form-control"  value="<?= $row->calamiteitTitel ?>" name="titleName" placeholder="Titel van calamiteit">
                             </div>
                           <div class="form-group">
                            <label for="exampleInputName2">Omschrijving van calamiteit</label>
            <input type="textarea" class="form-control" value="<?= $row->omschrijving ?>" rows="5" name="omschrijvingName" placeholder="Omschrijving">
                           </div>
                           <div class="form-group">
                            <label for="exampleInputName3">Categorie</label>
             <input type="text" class="form-control" value="<?= $row->categorie ?>"  name="categorieName" placeholder="Categorie">
                           </div>
                            <div class="form-group">
                            <label for="exampleInputName4">Locatie naam</label>
             <input type="text" class="form-control" value="<?= $row->locatie ?>" name="locatieName" placeholder="Locatie">
                            </div>
                           <div class="form-group">
                            <label for="exampleInputName5">Maand</label>
             <input type="text" class="form-control" value="<?= $row->maand ?>" name="maandName" placeholder="Maand">
                           </div>
                              <div class="form-group">
                            <label for="exampleInputName6">Dag van de week</label>
             <input type="text" class="form-control" value="<?= $row->dag ?>" name="dagName" placeholder="Dag">
                              </div>
                             <div class="form-group">
                            <label for="exampleInputName7">Datum getal</label>
             <input type="text" class="form-control" value="<?= $row->dagGetal ?>" name="dagGetalName" placeholder="Getal dag">
                             </div>
                            <div class="form-group">
                            <label for="exampleInputName8">Start tijd</label>
              <input type="text" class="form-control" value="<?= $row->start ?>" name="startName" placeholder="Start">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputName9">Eind tijd</label>
              <input type="text" class="form-control" value="<?= $row->eind ?>" name="eindName" placeholder="Eind">
                            </div>
                           <div class="form-group">
                            <label for="exampleInputName10">Email contactpersoon</label>
                                   <input type="text" class="form-control" value="<?= $row->email ?>" name="emailName" placeholder="Email"><br>
                           </div>
                           
       <div class="form-group">
                            <label for="exampleInputName11">Telefoonnummer contactpersoon</label>
              <input type="text" class="form-control" value="<?= $row->phone ?>" name="phoneName" placeholder="Telefoonnummer">
       </div>
                              <div class="form-group">
                                <label for="exampleInputName12">Wat te doen bij calamiteit</label>
              <input type="text" class="form-control" value="<?= $row->about ?>" rows="5" name="inhoudName" placeholder="Inhoud">
                              </div>
                            <div class="form-group">
                                <label for="exampleInputName13">Latitude</label>
              <input type="text" class="form-control" value="<?= $row->latitude ?>" name="latitudeName" placeholder="Latitude">
                            </div>
                           <div class="form-group">
                                <label for="exampleInputName14">Longitude</label>
              <input type="text" class="form-control" value="<?= $row->longitude ?>" name="longitudeName" placeholder="Longitude">
                           </div>
                           <div class="form-group">
                                <label for="exampleInputName15">Afbeelding Url</label>
              <input type="text" class="form-control" value="<?= $row->photo ?>" name="photoName" placeholder="Photo">
                           </div>
                            <div class="form-group">
                                        <label for="exampleInputName16">Vraag 1</label>
              <input type="text" class="form-control" value="<?= $row->vraag1Titel ?>" name="vraag1Name" placeholder="vraag1Titel">
                            </div>
                            <div class="form-group">
                                        <label for="exampleInputName17">Vraag 2</label>
              <input type="text" class="form-control" value="<?= $row->vraag2Titel ?>" name="vraag2Name" placeholder="vraag2Titel">
                            </div>
                            <div class="form-group">
                                        <label for="exampleInputName17">Vraag 3</label>
              <input type="text" class="form-control" value="<?= $row->vraag3Titel ?>" name="vraag3Name" placeholder="vraag3Titel">
                            </div>
                            <div class="form-group">
                                        <label for="exampleInputName17">Vraag 4</label>
              <input type="text" class="form-control" value="<?= $row->vraag4Titel ?>" name="vraag4Name" placeholder="vraag4Titel">
                            </div>
                            <div class="form-group">
                                        <label for="exampleInputName17">Vraag 5</label>
              <input type="text" class="form-control" value="<?= $row->vraag5Titel ?>" name="vraag5Name" placeholder="vraag5Titel">
                            </div>
                            <div class="form-group">
                                        <label for="exampleInputName21">Template</label>
              <input type="text" class="form-control" value="<?= $row->template ?>" name="templateName" placeholder="Template">
                            </div>
            <input type="hidden" class="form-control" class="form-control" name="_token" value="{{ csrf_token() }}">
            <input type="submit"  class="btn btn-primary" value="Save">
        </form> 
                    
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection
        
      