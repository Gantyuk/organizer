@extends('layouts.admin_app')

@section('content')
    <div class="container">
        @component('components.breadcrumb')
            @slot('title')Task Update @endslot
            @slot('parent')Home @endslot
            @slot('child_task_parent')Tasks @endslot
            @slot('active')Edit Task @endslot
        @endcomponent
        <hr>
        <form class="form-horizontal" action="{{route('task.update',$task)}}" method="post">
            {{method_field('PUT')}}
            @csrf
            @include('auth.admin.task.partials.form')
        </form>
@endsection
