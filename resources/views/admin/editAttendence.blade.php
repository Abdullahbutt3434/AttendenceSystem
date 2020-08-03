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
                                                    <h2 class="card-title">Name:{{$user->name }} </h2>

                                                    <form action="{{isset($att_id) ? route('updateAttendence' , [$att_id->id] ): route('storeAttendence')}}" method="POST">
                                                        @csrf
                                                        @if(isset($att_id))
                                                            @method('PUT')
                                                        @endif
                                                        <div class="form-group">
                                                            <label for="presence">Attendence</label>
                                                            <select name="presence" class="form-control">
                                                                <option value="present" {{isset($att_id) ?($att_id->presence) == "present" ? "selected" : "":""  }}>present</option>
                                                                <option value="absent" {{ isset($att_id) ?($att_id->presence) == "absent" ? "selected" : "":"" }}>absent</option>
                                                                <option value="leave" {{isset($att_id) ?($att_id->presence) == "leave" ? "selected" : "":""  }}>leave</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Date</label>
                                                            <input type="text" class="date form-control" name="date"  id="date" value="{{isset($att_id) ? $date : "" }}" {{isset($att_id)?"disabled":""}} placeholder="Enter Date">
                                                        </div>
                                                        <input type="text" name="user_id" value="{{$user->id}}" hidden>
                                                        <div class="form-group">
                                                            <input type="submit" class="btn btn-lg btn-primary"   value="{{isset($att_id)?"Update":"Add Attendence"}}">
                                                        </div>

                                                    </form>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


