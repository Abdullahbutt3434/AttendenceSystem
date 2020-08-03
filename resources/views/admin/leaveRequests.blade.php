@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Leave Requests</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-primary" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @foreach( $request as $request)
                        <div class="bs-example">
                                <div class="alert alert-warning alert-dismissible fade show">
                                    Leave Request From <strong>{{$request->name}}</strong> at Date: {{$request->date}}
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <form class="float-right ml-2" action="{{route('acceptLeave',[$request->user_id,$request->date])}}" method="POST">
                                        @csrf
                                        <input type="submit" class="btn btn-sm btn-primary" value="Accpet">
                                    </form>

                                    <form class="float-right" action="{{route('rejectLeave',[$request->user_id,$request->date])}}" method="POST">
                                        @csrf
                                        <input type="submit" class="btn btn-sm btn-danger" value="Reject">
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
