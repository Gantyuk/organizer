@extends('layouts.admin_app')

@section('content')

    <div class="container">

        <div class="alert alert-success float-right" style="margin-left: 50px; margin-top: 10px"> Count of Task : <h4
                    class="text-center">{{$count}}</h4></div>
        @component('components.breadcrumb')
            @slot('title')Tasks list @endslot
            @slot('parent')Home @endslot
            @slot('active')Tasks @endslot
        @endcomponent
        <hr>
        <a href="{{route('task.create')}}" class="btn btn-primary  float-right"
           style="margin-right: 10px;margin-bottom: 15px">
            <i class="fa fa-plus-square-o"></i> Create Task
        </a>

        <table class="table table-striped">
            <thead>
            <th>Name</th>
            <th>User</th>
            <th>Date</th>
            <th>Importance</th>
            <th>Status</th>
            <th class="text-right">Edit</th>
            </thead>
            <tbody>
            @forelse($tasks as $task)
                <tr>
                    <td>{{$task->name}}</td>
                    <td>{{$task->user->name}}</td>
                    <td>{{$task->created_at}}</td>
                    <td>{{$task->importance}}</td>
                    <td>{{$task->status}}</td>
                    <td>
                        <form onsubmit="if(confirm('Delete?')){return true}else{ return false}"
                              action="{{route('task.destroy',$task)}}" method="post">
                            {{method_field('DELETE')}}
                            @csrf

                            <a href="{{route('task.edit',$task)}}" method="post">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button type="submit" class="btn"><i class="fa fa-trash-o"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center"><h2>No Task</h2></td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <td colspan="6">
                    <ul class="pagination pull-right">
                        {{$tasks->links()}}
                    </ul>
                </td>
            </tr>
            </tfoot>
        </table>

    </div>
@endsection
