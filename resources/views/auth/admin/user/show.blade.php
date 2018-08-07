@extends('layouts.admin_app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        <img src="{{asset('/storage/'.$user->img_path)}}"
                             style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                        <h2>User : {{$user->name}}</h2>
                        <h4>Email : {{$user->email}}</h4>

                        <form onsubmit="if(confirm('Delete?')){return true}else{ return false}"
                              action="{{route('user.destroy',$user)}}" method="post">
                            {{method_field('DELETE')}}
                            @csrf
                            <a href="{{route('user.edit',$user)}}" class="btn">
                                <i class="fa fa-edit"> </i>Edit
                            </a>
                            <button type="submit" class="btn"><i class="fa fa-trash-o"></i>Delete</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
