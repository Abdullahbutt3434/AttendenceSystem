@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Profile</div>
                    <div class="card-body">


                        <div class="container-fluid mb-5 ">
                            <div class="row ">
                                <div class="col-12">
                                    <div class="card card-inverse p-3 border border-primary" style="background-color: white;">
                                        <div class="card-block">
                                            <div class="row ">
                                                <div class="col-md-8 col-sm-8 ">
                                                    <h2 class="card-title">Name: {{$user->name}}</h2>
                                                    <p class="card-text"><strong>Registration No: {{$user->RegNo}}</strong></p>
                                                    <p class="card-text"><strong>Grades: </strong> {{$user->grade}} </p>
                                                </div>
                                                <div class="col-md-4 col-sm-4 text-center">
                                                    <img class="btn-md" src="{{asset('/').$user->image}}" alt="" width="50%" style="border-radius:50%;">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="{{route('user.update' , $user->id)}}}}" method="POST" enctype="multipart/form-data">
                            @csrf
                                @method('PUT')
                            <div class="form-group">

                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" value="{{$user->name}}" >
                                @error('name')
                                <div class="alert alert-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>



                            <div class="form-group">
                                <label for="image">Change Profile Image</label>
                                <input id="image" class="form-control" type="file" name="image">
                                @error('image')
                                <div class="alert alert-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <button class="btn btn-success" type="submit" >
                                    Update Profile
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
