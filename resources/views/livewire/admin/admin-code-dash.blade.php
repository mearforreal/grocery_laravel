@extends('layouts.admin')

@section('main')




    <h2>Code</h2>
    <div class="col-sm-6">
        <button type="button" class="btn btn-primary my-4" data-toggle="modal" id="addNew"  data-target="#staticBackdrop">
            <i class="fas fa-plus"></i>ADD NEW
        </button>


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
                <th>Code</th>
                <th>%</th>
                <th></th>
                <th></th>



            </tr>
            </thead>
            <tbody>
            @foreach($codes as $code)
                <tr>
                    <td>{{$code->id}}</td>
                    <td>{{$code->code}}</td>
                    <td>{{$code->code_percentage}}
{{--                        @if($code->code_percentage === "ADM")--}}
{{--                            <span>Admin</span>--}}
{{--                            @elseif($user->utype === "USR")--}}
{{--                                <span>User</span>--}}
{{--                        @endif--}}

                    </td>
                    <td><a href="#" class="btn btn-primary">Edit</a></td>
                    <td><a href="#" class="btn btn-danger">Delete</a></td>
                    {{--td><a href="{{route('adminEditUserForm',['id'=>$user['id']])}}" class="btn btn-primary">Edit</a></td>
                    <td><a href="{{route('adminDeleteUser',['id'=>$user['id']])}}" class="btn btn-danger">Delete</a></td>--}}



                </tr>
            @endforeach


            </tbody>
        </table>


    </div>
    <form action="{{route('adminAddCode')}}" method="post">
        @csrf
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog col-sm-5 offset-3">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Code</label>
                            <input type="text" class="form-control" name="code" minlength="6" maxlength="6"  required>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <select class="form-control" name="percentage">
                                <option value="0.1">10%</option>
                                <option value="0.2">20%</option>
                                <option value="0.3">30%</option>
                                <option value="0.5">50%</option>

                            </select>
                        </div>






                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
