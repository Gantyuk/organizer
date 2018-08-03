@extends('layouts.admin_app')

@section('content')

    <div class="container">

        <div class="alert alert-success float-right" style="margin-left: 50px; margin-top: 10px"> Count of registret users: <h4 class="text-center">{{$count}}</h4></div>
        @component('components.breadcrumb')
            @slot('title')Users list @endslot
            @slot('parent')Home @endslot
            @slot('active')Users @endslot
        @endcomponent
        <hr>
            {{--<a href="{{route('admin.admin.create')}}" class="btn btn-primary float-right" >
                <i class="fa fa-plus-square-o"></i> Create Admin
            </a>--}}
       <a href="{{route('user.create')}}" class="btn btn-primary  float-right" style="margin-right: 10px;margin-bottom: 15px">
            <i class="fa fa-plus-square-o"></i> Create User
           </a>

        <table class="table table-striped">
            <thead>
            <th>Name</th>
            <th>Email</th>
            <th class="text-right">Edit</th>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <form onsubmit="if(confirm('Delete?')){return true}else{ return false}"
                              action="{{route('user.destroy',$user)}}" method="post">
                            {{method_field('DELETE')}}
                            @csrf

                            <a href="{{route('user.edit',$user)}}" method="post">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button type="submit" class="btn"><i class="fa fa-trash-o"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center"><h2>No user</h2></td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3">
                    <ul class="pagination pull-right">
                        {{$users->links()}}
                    </ul>
                </td>
            </tr>
            </tfoot>
        </table>

    </div>
@endsection
