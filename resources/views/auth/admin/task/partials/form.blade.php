@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error )
            <li>{{$error}}</li>
        @endforeach

    </div>
@endif
<label for="">Name</label>
<input type="text" class="form-control" name="name" placeholder="Name"
       value="@if(old('name')){{old('name')}}@else{{$task->name or ""}}@endif" required>

<label for="">User</label>
{{Form::select('user_id', $tasks_list, e(isset($task->user->id))? $task->user->id : null , [ 'placeholder'=>" Select User Name",'class' => 'form-control'])}}
<label for="">Importance</label>
{{Form::select('importance', [
            "Important"=>"Important",
            "Not important"=>"Not Important",
],e(isset($task->importance))? $task->importance : null  , [ 'class' => 'form-control'])}}

<label for="">Status</label>
{{Form::select('status', [
            "New"=>"New",
            "Executed"=>"Executed",
            "Canceled"=>"Canceled",
],e(isset($task->status))? $task->status : null  , [ 'class' => 'form-control'])}}

<label for="">Avatar</label>
<input type="file" name="image" class="form-control" />


<hr>
<input class="btn btn-primary" type="submit" value="Save">