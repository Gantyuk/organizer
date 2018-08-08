@extends('layouts.admin_app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        <img src="{{asset('/storage/'.$task->img_path)}}"
                             style="width:350px; height:350px; float:left; border-radius:20%; margin-right:25px;">
                        <h1> {{$task->name}}</h1>
                        <h4 class="text-center">User :<a href="{{route('user.show', $task->user)}}">{{$task->user->name}}</a></h4>
                        <h4 class="text-center">Importance : {{$task->importance }}</h4>
                        <h4 class="text-center">Status : {{$task->status }}</h4>
                        <h4 class="text-center">{{$task->created_at->format('d/m/Y')}}</h4>
                        <p>
                        <form onsubmit="if(confirm('Delete?')){return true}else{ return false}"
                              action="{{route('task.destroy',$task)}}" method="post" class="text-center">
                            {{method_field('DELETE')}}
                            @csrf
                            <a href="{{route('task.edit',$task)}}" class="btn">
                                <i class="fa fa-edit"> </i>Edit
                            </a>
                            <button type="submit" class="btn"><i class="fa fa-trash-o"></i>Delete</button>
                        </form>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
