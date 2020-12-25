@extends('layouts.admin')

@section('main')




    <h2>Products</h2>

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
                <th>Date</th>
                <th>Price</th>
                <th>Coupon</th>
                <th>Details</th>
                <th>Delete</th>



            </tr>
            </thead>
            <tbody>
            @foreach($orderItems as $orderItem)
                <tr>
                    <td>{{$orderItem->id}}</td>
                    <td>{{$orderItem->date}}</td>
                    <td>{{$orderItem->price}}
{{--                        @if($code->code_percentage === "ADM")--}}
{{--                            <span>Admin</span>--}}
{{--                            @elseif($user->utype === "USR")--}}
{{--                                <span>User</span>--}}
{{--                        @endif--}}

                    </td>
                    <td>{{$orderItem->codes->code_percentage*100}}%</td>
                    <td><a href="{{route('adminOrderDetails',['id'=>$orderItem->id])}}" class="btn btn-info">Details</a></td>
                    <td><a href="{{route('adminDeleteOrder',['id'=>$orderItem->id])}}" class="btn btn-danger">Delete</a></td>
                    {{--td><a href="{{route('adminEditUserForm',['id'=>$user['id']])}}" class="btn btn-primary">Edit</a></td>
                    <td><a href="{{route('adminDeleteUser',['id'=>$user['id']])}}" class="btn btn-danger">Delete</a></td>--}}



                </tr>
            @endforeach


            </tbody>
        </table>


    </div>

@endsection
