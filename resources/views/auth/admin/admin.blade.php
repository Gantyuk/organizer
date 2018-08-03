@extends('layouts.admin_app')

@section('content')

    <div class="container">

        <div class="alert alert-primary float-right"> Count of registret users: <h4
                    class="text-center">{{$count_user}}</h4></div>
        <div class="alert alert-success float-right" style="margin-right: 15px"> Count of online users: <h4
                    class="text-center">{{$count_user_online}}</h4></div>

        <table class="table table-striped">
            <thead>
            <th>Online user</th>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>

                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center"><h2>No user</h2></td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
@endsection
