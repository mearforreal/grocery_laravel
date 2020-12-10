@extends('layouts.admin')

@section('main')

    <div class="row mt-5">
        <div class="col-sm-6 offset-3">
            <form action="/admin/updateUser/{{$user->id}}" method="post">
                {{csrf_field()}}

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="user_name" value="{{$user->name}}" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="{{$user->email}}"  required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="text" class="form-control" name="password"   required>
                </div>


                <div class="form-group">
                    <label>User Role</label>
                    <select class="form-control" name="role">
                        <option value="USR">User</option>
                        <option value="ADM">Admin</option>
                    </select>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>


            </form>
        </div>

    </div>



@endsection
