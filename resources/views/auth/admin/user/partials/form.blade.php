@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error )
            <li>{{$error}}</li>
        @endforeach

    </div>
@endif
<label for="">Name</label>
<input type="text" class="form-control" name="name" placeholder="User Name"
       value="@if(old('name')){{old('name')}}@else{{$user->name or ""}}@endif" required>

<label for="">Email</label>
<input type="email" class="form-control" name="email" placeholder="User email"
       value="@if(old('email')){{old('email')}}@else{{$user->email or ""}}@endif" required>

<label for="">Password</label>
<input type="password" class="form-control" name="password">

<label for="">Confirm Password</label>
<input type="password" class="form-control" name="password_confirmation">

<hr>
<input class="btn btn-primary" type="submit" value="Save">