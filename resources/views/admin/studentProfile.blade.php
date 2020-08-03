@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
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
                                                    <p class="card-text"><strong>Present: </strong> {{$pCount}} </p>
                                                    <p class="card-text"><strong>Absent: </strong> {{$aCount}} </p>
                                                    <p class="card-text"><strong>Leaves: </strong> {{$lCount}} </p>
                                                    <div>
                                                        <form action="{{route('addAttendence', $user->id)}}" method="POST">
                                                            @csrf
                                                            <input type="submit" class="btn btn-primary btn-sm" name="addAttendence" value="Add Attendene">
                                                        </form>
                                                    </div>

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


                        <table class="table table-striped table-dark">
                            <thead>
                            <tr class="bg-primary">
                                <th>Presents Record</th>
                            </tr>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Attendence</th>
                                <th scope="col">Date</th>
                                <th scope="col"></th>
                                <th scope="col"></th>


                            </tr>
                            </thead>
                            <tbody>
                            @php($i=0)
                            @foreach($present as $p)
                                <tr>
                                    <th scope="row">{{$i=$i+1}}</th>
                                    <td>{{$p->presence}}</td>
                                    <td>{{$p->date}}</td>
                                    <td>
                                        <form  action="{{route('editAttendence' , [$p->id] )}}" method="POST">
                                            @csrf
                                            @method('GET')
                                            <input type="submit" class="btn btn-primary btn-sm" value="Edit "  >
                                        </form>
                                    </td>

                                    <td>
                                        <form  action="{{route('deleteAttendence' , [$p->id] )}}" method="POST">
                                            @csrf
                                            <input type="text" value="{{$user->id}}" name="user_id" hidden >
                                            <input type="submit" class="btn btn-primary btn-sm" value="Delete"  >
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <table class="table table-striped table-dark">
                            <thead>

                            <tr class="bg-warning">
                                <th>Leaves Record</th>
                            </tr>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Attendence</th>
                                <th scope="col">Date</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=0)
                            @foreach($leave as $l)
                                <tr>
                                    <th scope="row">{{$i=$i+1}}</th>
                                    <td>{{$l->presence}}</td>
                                    <td>{{$l->date}}</td>
                                    <td>
                                        <form  action="{{route('editAttendence',[$l->id] )}}" method="POST">
                                            @csrf
                                            @method('GET')
                                            <input type="submit" class="btn btn-primary btn-sm" value="Edit"  >
                                        </form>
                                    </td>

                                    <td>
                                        <form  action="{{route('deleteAttendence' , [$l->id] )}}" method="POST">
                                            @csrf
                                            <input type="text" value="{{$user->id}}" name="user_id" hidden >
                                            <input type="submit" class="btn btn-primary btn-sm" value="Delete"  >
                                        </form>
                                    </td>


                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <table class="table table-striped table-dark">
                            <thead>
                            <tr class="bg-danger">
                                <th>Absentes Record</th>
                            </tr>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Attendence</th>
                                <th scope="col">Date</th>
                                <th></th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody>
                            @php($i=0)
                            @foreach($absent as $a)
                                <tr>
                                    <th scope="row">{{$i=$i+1}}</th>
                                    <td>{{$a->presence}}</td>
                                    <td>{{$a->date}}</td>
                                    <td>
                                        <form  action="{{route('editAttendence' , [$a->id] )}}" method="POST">
                                            @csrf
                                            @method('GET')
                                            <input type="submit" class="btn btn-primary btn-sm" value="Edit"  >
                                        </form>
                                    </td>

                                    <td>
                                        <form  action="{{route('deleteAttendence' , [$a->id] )}}" method="POST">
                                            @csrf
                                            <input type="text" value="{{$user->id}}" name="user_id" hidden >
                                            <input type="submit" class="btn btn-primary btn-sm" value="Delete"  >
                                        </form>
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
@endsection
