@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Voeg een calamiteit toe</div>
                <div class="panel-body">

                    <form action="" method="post"> 
                        <div class="form-group">
                            <label for="exampleInputName1">Titel van calamiteit</label>
                            <input type="text" class="form-control" name="titleName" placeholder="Titel van calamiteit">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName2">Omschrijving van calamiteit</label>
                       
                             <textarea name="inhoudName" placeholder="Omschrijving" class="form-control" rows="5" id="comment"></textarea> 
                        </div>
                     <!--<input type="text" class="form-control" name="categorieName" placeholder="Categorie"><br>-->
                        <div class="form-group">
                            <label for="exampleInputName3">Categorie</label>
                            <select class="form-control" name ="categorieName">
                                <option value="Asbest">Asbest</option>
                                <option value="Hittegolf">Hittegolf</option>
                                <option value="InfectieZiekte">InfectieZiekte</option>
                                <option value="Overige">Overige</option> 
                            </select></div>
                        <div class="form-group">
                            <label for="exampleInputName4">Locatie naam</label>
                            <input type="text" class="form-control" name="locatieName" placeholder="Locatie">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName5">Maand</label>
                            <select class="form-control" name ="maandName">
                                <option value="Januari">Januari</option>
                                <option value="Februari">Februari</option>
                                <option value="Maart">Maart</option>
                                <option value="April">April</option>
                                <option value="Mei">Mei</option>
                                <option value="Juni">Juni</option>
                                <option value="Juli">Juli</option>
                                <option value="Augustus">Augustus</option> 
                                <option value="September">September</option> 
                                <option value="Oktober">Oktober</option> 
                                <option value="November">November</option> 
                                <option value="December">December</option> 
                            </select></div>
                        <div class="form-group">
                            <label for="exampleInputName6">Dag van de week</label>
                            <select class="form-control" name ="dagName">
                                <option value="Maandag">Maandag</option>
                                <option value="Dinsdag">Dinsdag</option>
                                <option value="Woendag">Woensdag</option>
                                <option value="Donderdag">Donderdag</option>
                                <option value="Vrijdag">Vrijdag</option>
                                <option value="Zaterdag">Zaterdag</option>
                                <option value="Zondag">Zondag</option> 
                            </select></div>
                        <div class="form-group">
                            <label for="exampleInputName7">Datum getal</label>
                            <input type="text" class="form-control" name="dagGetalName" placeholder="Getal dag">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName8">Start tijd</label>
                            <input type="text" class="form-control" name="startName" placeholder="Start">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName9">Eind tijd</label>
                            <input type="text" class="form-control" name="eindName" placeholder="Eind">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName10">Email contactpersoon</label>
                            <input type="text" class="form-control" name="emailName" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName11">Telefoonnummer</label>
                            <input type="text" class="form-control" name="phoneName" placeholder="Telefoonnummer">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName12">Wat te doen bij calamiteit</label>
                      
                            <textarea name="omschrijvingName" placeholder="Omschrijving" class="form-control" rows="5" id="comment"></textarea>
                             
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName13">Latitude</label>
                            <input type="text" class="form-control" name="latitudeName" placeholder="Latitude">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName14">Longitude</label>
                            <input type="text" class="form-control" name="longitudeName" placeholder="Longitude">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName15">Afbeelding Url</label>
                            <input type="text" class="form-control" name="photoName" placeholder="Afbeelding">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName16">Vraag 1</label>
                            <input type="text" class="form-control" name="vraag1Name" placeholder="vraag1Titel">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName17">Vraag 2</label>
                            <input type="text" class="form-control" name="vraag2Name" placeholder="vraag2Titel">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName18">Vraag 3</label>
                            <input type="text" class="form-control" name="vraag3Name" placeholder="vraag3Titel">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName19">Vraag 4</label>
                            <input type="text" class="form-control" name="vraag4Name" placeholder="vraag4Titel">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName20">Vraag 5</label>
                            <input type="text" class="form-control" name="vraag5Name" placeholder="vraag5Titel">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName21">calamiteitTemplate of vragenlijstTemplate</label>
                            <input type="text" class="form-control" name="templateName" placeholder="Template"><br>
                        </div>
                        <!--
                         <div class="form-group">
                             <label for="exampleInputName21">Wat te doen bij calamiteit</label>
                             <select class="form-control" name ="templateName">
                                 <option value="calamiteitTemplate">Melding</option>
                                 <option value="vragenlijstTemplate">Vragenlijst</option>
                             </select>
                         </div>
                        -->
                        <input type="hidden" class="form-control" class="form-control" name="_token" value="{{ csrf_token() }}">
                        <input type="submit"  class="btn btn-primary" value="Save">
                    </form> 

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

