@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">ALl Students</div>
                    <div class="card-body">

                        @foreach($users as $users)
                        <div class="card m-2" style="width: 15rem; float: left " >
                            <div class="card-body p-3" >
                                <h5 class="card-title">{{$users->name}}</h5>
                                <p class="card-text">Registration Number: {{$users->RegNo}}</p>
                                <form action="{{route('viewStudent' , $users->id)}}" method="POST">
                                    @csrf
                                    @method('GET')
                                <input type="submit" class="btn btn-primary" value="View Profile">
                                </form>
                            </div>
                        </div>
                        @endforeach


                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection
