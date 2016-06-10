@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Voeg een calamiteit toe</div>
                <div class="panel-body">

                       <form action="" method="post"> 
                        <input type="hidden" name="id" value="<?= $row->id ?>">
                        <div class="form-group">
                            <label for="exampleInputName1">Titel van calamiteit</label>
                            <input type="text" class="form-control"  value="<?= $row->calamiteitTitel ?>" name="titleName" placeholder="Titel van calamiteit">
                        </div>
                            <input type="hidden" class="form-control" value="<?= $row->about ?>"  name="inhoudName">
                            <input type="hidden" class="form-control" value="<?= $row->categorie ?>"  name="categorieName">
                            <input type="hidden" class="form-control" value="<?= $row->locatie ?>" name="locatieName">
                            <input type="hidden" class="form-control" value="<?= $row->maand ?>" name="maandName">
                            <input type="hidden" class="form-control" value="<?= $row->dag ?>" name="dagName">
                            <input type="hidden" class="form-control" value="<?= $row->dagGetal ?>" name="dagGetalName">
                            <input type="hidden" class="form-control" value="<?= $row->start ?>" name="startName" >                              
                            <input type="hidden" class="form-control" value="<?= $row->eind ?>" name="eindName">     
                            <input type="hidden" class="form-control" value="<?= $row->email ?>" name="emailName">                       
                            <input type="hidden" class="form-control" value="<?= $row->phone ?>" name="phoneName">
                            <input type="hidden" class="form-control" value="<?= $row->omschrijving ?>" name="omschrijvingName">
                            <input type="hidden" class="form-control" value="<?= $row->latitude ?>" name="latitudeName" >                      
                            <input type="hidden" class="form-control" value="<?= $row->longitude ?>" name="longitudeName" >                                    
                            <input type="hidden" class="form-control" value="<?= $row->photo ?>" name="photoName">
                            <input type="hidden" class="form-control" value="<?= $row->template ?>" name="templateName">
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
                            
                              <input type="hidden" class="form-control" value="vragenlijstTemplate" name="templateName">
                        
                        <input type="hidden" class="form-control" class="form-control" name="_token" value="{{ csrf_token() }}">
                        <input type="submit"  class="btn btn-primary" value="Save">
                    </form> 

                </div>
            </div>
        </div>
    </div>
</div> 
@endsection

