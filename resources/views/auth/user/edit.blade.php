@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Edit Profile</div>
                    <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        <form method="post" action="{{route('user.profile.update')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('patch') }}
                            <div class="form-group">
                                <div class=" row ">
                                    <div class="col-md-4"><label for="name"
                                                                 class=" control-label float-right">Name</label>

                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class=" row ">
                                    <div class="col-md-4"><label for="name"
                                                                 class=" control-label float-right">Email</label>

                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="email" value="{{ $user->email }}" class="form-control" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class=" row ">
                                    <div class="col-md-4"><label for="name"
                                                                 class=" control-label float-right">Avatar</label>

                                    </div>
                                    <div class="col-md-8">
                                        <input type="file" name="image"  class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-6 ">
                                    <button type="submit" class="btn btn-primary">
                                        Save chenges
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection