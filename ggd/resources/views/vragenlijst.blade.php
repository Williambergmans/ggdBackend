@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Ontvangen vragenlijsten
                </div>
                <div class="list-group">
                    <div class="list-group-item">
                            <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Titel</th>
                                    <th>Vraag1</th>
                                    <th>Vraag2</th>
                                    <th>Vraag3</th>
                                    <th>Vraag4</th>
                                    <th>Vraag5</th>
                                    <th>Mail</th>
                                    <th>Datum</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vragenlijst as $row)
                                <tr>
                                    <td>{{ $row->titel }}</td>
                                    <td>{{ $row->vraag1 }}</td>
                                    <td>{{ $row->vraag2 }}</td>
                                    <td>{{ $row->vraag3 }}</td>
                                    <td>{{ $row->vraag4 }}</td>
                                    <td>{{ $row->vraag5 }}</td>
                                    <td>{{ $row->mail }}</td>
                                    <td>{{ $row->created_at }}</td>
                                    <td>
                                       <span><a href="<?php echo 'DeleteVragenlijst/' . $row->id ?>" class="btn btn-info" role="button">Verwijder</a></span>
                                    </td>
                                </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>  
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection

