@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="card">
                    <div class="card-header">Registration no:  {{$user->RegNo }}</div>
                    <div class="card-body">
                        <h3>Mark Addtendence</h3>
                        <form action="{{route('user.store')}}" method="POST">
                            @csrf
                            <input class="btn btn-primary btn-lg ml-1" type="submit" value="Present">
                        </form>

                        <form action="{{route('leaveRequest')}}" method="POST">
                            @csrf
                            <input class="btn btn-secondary btn-lg ml-1 mt-3" type="submit" value="Request Leave">
                        </form>


                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection
