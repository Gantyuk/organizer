@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tasks</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-striped">
                            <thead>
                            <th>Name</th>
                            <th>Importance</th>
                            <th>Status</th>
                            <th>Date</th>
                            </thead>

                            <tbody>
                            @foreach($tasks as $task)
                            <tr>
                                <td> {{--todo href--}}
                                    <a href="{{route('showtask',$task)}}">{{ $task->name }}</a>
                                </td>
                                <td>{{ $task->importance }}</td>
                                <td>{{ $task->status }}</td>
                                <td>{{ $task->created_at }}</td>
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
