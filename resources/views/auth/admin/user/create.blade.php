@extends('layouts.admin_app')

@section('content')
    <div class="container">
        @component('components.breadcrumb')
            @slot('title')Users Create @endslot
            @slot('parent')Home @endslot
            @slot('child_parent')Users @endslot
            @slot('active')Create User @endslot
    @endcomponent
            <hr>
            <form class="form-horizontal" action="{{route('user.store')}}" method="post">
                @csrf
                @include('auth.admin.user.partials.form')
            </form>
    </div>
@endsection
