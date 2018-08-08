@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        <img src="{{asset('/storage/'.$user->img_path)}}"
                             style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                        <h2>{{$user->name}}`s Profile!</h2>
                        <h4>Email : {{$user->email}}</h4>

                        <a  class="btn btn-primary" href="{{route('user.changePassword')}}">
                            Change Password
                        </a>
                        <a  class="btn btn-warning" href="{{route('user.profile.edit')}}">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
