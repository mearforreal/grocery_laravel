@extends('layouts.admin')

@section('main')




    <h2>Users</h2>
    <div class="col-sm-6">

        <a href="{{route('adminAddUserDisplay')}}" class="btn btn-info">Add user</a>

    </div>
    <div class="table-responsive">
        {{--                @if($errors->any)--}}
        {{--                    <div class="alert alert-danger">--}}
        {{--                        <ul>--}}
        {{--                            <li>{!! print_r($errors->all())!!}</li>--}}
        {{--                        </ul>--}}
        {{--                    </div>--}}
        {{--                @endif--}}
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#ID</th>
                <th>Email</th>
                <th>Role</th>
                <th>Password</th>
                <th>Edit Role</th>
                <th>Delete</th>


            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->email}}</td>
                    <td>@if($user->utype === "ADM")
                            <span>Admin</span>
                            @elseif($user->utype === "USR")
                                <span>User</span>
                        @endif

                    </td>
                    <td>{{$user->password}}</td>
                    <td><a href="{{route('adminEditUserForm',['id'=>$user['id']])}}" class="btn btn-primary">Edit</a></td>
                    <td><a href="{{route('adminDeleteUser',['id'=>$user['id']])}}" class="btn btn-danger">Delete</a></td>



                </tr>
            @endforeach


            </tbody>
        </table>


    </div>



@endsection
