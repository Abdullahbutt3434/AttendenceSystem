@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Attendence Record</div>
                    <div class="card-body">
                        <table class="table table-striped table-dark">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Attendence</th>
                                <th scope="col">Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=0)
                            @foreach($user_record as $record)
                            <tr>
                                <th scope="row">{{$i=$i+1}}</th>
                                <td>{{$record->presence}}</td>
                                <td>{{$record->date}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
