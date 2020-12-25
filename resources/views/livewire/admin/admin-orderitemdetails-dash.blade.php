@extends('layouts.admin')

@section('main')

    <div class="row mt-5">
        <div class="col-sm-6 offset-3">
            <div class="card">
                <div class="card-header  text-center">
                    Order details
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Price</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['orderDetails'] as $item)
                            <tr>
                                <th scope="row">{{$item['id']}}</th>
                                <td>{{$item['item_name']}}</td>
                                <td>{{$item['item_price']}}</td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <h6><strong>Address:</strong></h6>
                        <p class="pl-3">{{$data['order']['address']}}</p>
                    </div>
                    <div class="row">
                        <h6><strong>Full Name:</strong></h6>
                        <p class="pl-3">{{$data['order']['full_name']}}</p>
                    </div>
                    <div class="row">
                        <h6><strong>Telephone:</strong></h6>
                        <p class="pl-3">{{$data['order']['telephone']}}</p>
                    </div>

                </div>
            </div>

        </div>

    </div>



@endsection
