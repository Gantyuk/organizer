@extends('layouts.admin_app')

@section('content')
    <div class="container">
        @component('components.breadcrumb')
            @slot('title') Tasks Create @endslot
            @slot('parent') Home @endslot
            @slot('child_task_parent') Tasks @endslot
            @slot('active') Create Task @endslot
    @endcomponent
            <hr>
            <form class="form-horizontal" action="{{route('task.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @include('auth.admin.task.partials.form')
            </form>
    </div>
@endsection
