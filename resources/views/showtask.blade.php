@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        <img src="{{asset('/storage/'.$task->img_path)}}"
                             style="width:350px; height:350px; float:left; border-radius:20%; margin-right:25px;">
                        <h1> {{$task->name}}</h1>
                        <h4 class="text-center">Importance : {{$task->importance }}</h4>
                        <h4 class="text-center">Status : {{$task->status }}</h4>
                        <h4 class="text-center">{{$task->created_at->format('d/m/Y')}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
