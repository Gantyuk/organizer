@extends('layouts.admin_app')

@section('content')

    <div class="container">

        <div class="alert alert-success float-right" style="margin-left: 50px; margin-top: 10px">
            Count of Task : <h4 class="text-center" id="total_records"></h4></div>
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
        <a href="{{route('task.executed.all')}}" onclick="return confirm('Are you sure?')"
           class="btn btn-success  float-right"
           style="margin-right: 10px;margin-bottom: 15px">
            <i class="fa fa-check"></i> Mark all as Executed
        </a>

        <table class="table table-striped">
            <thead>
            <th>Name</th>
            <th>User</th>
            <th>Importance</th>
            <th>Status</th>
            <th>Date</th>
            <th class="text-right">Edit</th>
            <tr>
                <td>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" value=""/>
                </td>
                <td>
                    <input type="text" name="user" id="user" class="form-control" placeholder="User" value=""/>
                </td>
                <td> {{Form::select('importance', [
                        "Important"=>"Important",
                        "Not important"=>"Not Important",
                     ], null  , [ 'placeholder'=>"All" , 'class' => 'form-control','id'=>'importance'])}}
                </td>
                <td>
                    {{Form::select('status', [
                        "New"=>"New",
                        "Executed"=>"Executed",
                        "Canceled"=>"Canceled",
                    ],null , [ 'placeholder'=>"All",'class' => 'form-control','id'=>'status'])}}
                </td>
            </tr>
            </thead>

            <tbody>

            </tbody>
        </table>

    </div>
    <script>
        function fetch_customer_data(name = '', importance = '', status = '', user = '') {
            $.ajax({
                url: "{{ route('task.filtration') }}",
                method: 'GET',
                data: {
                    name: name,
                    user: user,
                    importance: importance,
                    status: status
                },
                dataType: 'json',
                success: function (data) {
                    $('tbody').html(data.table_data);
                    $('#total_records').text(data.total_data);
                }
            })
        }
        $(document).ready(function () {

            fetch_customer_data();



            $('#importance').change(function () {
                var name = $('#name').val(),
                    user = $('#user').val(),
                    status = $('#status').val(),
                    importance = $('#importance').val();
                fetch_customer_data(name, importance, status, user);
            });
            $('#status').change(function () {

                var name = $('#name').val(),
                    user = $('#user').val(),
                    status = $('#status').val(),
                    importance = $('#importance').val();
                fetch_customer_data(name, importance, status, user);
            });
            $(document).on('keyup', '#name', function () {
                var name = $('#name').val(),
                    user = $('#user').val(),
                    status = $('#status').val(),
                    importance = $('#importance').val();
                fetch_customer_data(name, importance, status, user);
            });

            $(document).on('keyup', '#user', function () {
                alert('dfg');
                var name = $('#name').val(),
                    user = $('#user').val(),
                    status = $('#status').val(),
                    importance = $('#importance').val();
                fetch_customer_data(name, importance, status, user);
            });
        });
        function execut  (e) {
            $.ajax({
                url: "{{ route('task.executed') }}",
                method: 'GET',
                data: {
                    id: $('#id').val()
                },
                dataType: 'json',
                success: function (data) {
                    if (data.success == "success") {
                        fetch_customer_data();
                    }
                }
            });
            e.preventDefault();

        }
    </script>

@endsection
