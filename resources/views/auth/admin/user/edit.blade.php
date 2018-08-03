@extends('layouts.admin_app')

@section('content')
    <div class="container">
        @component('components.breadcrumb')
            @slot('title')Users Update @endslot
            @slot('parent')Home @endslot
            @slot('child_parent')Users @endslot
            @slot('active')Edit User @endslot
        @endcomponent
        <hr>
        <form class="form-horizontal" action="{{route('user.update',$user)}}" method="post">
            {{method_field('PUT')}}
            @csrf
            @include('auth.admin.user.partials.form')
        </form>
@endsection
