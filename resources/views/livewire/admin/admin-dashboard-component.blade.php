@extends('layouts.admin')

@section('main')




            <h2>Products</h2>
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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Type</th>
                            <th>Edit Image</th>
                            <th>Edit</th>
                            <th>Remove</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td><img src="{{Storage::disk('local')->url('product_images/'.$product->image)}}" alt="" style="width: 40px"></td>


                                <td>{{$product->name}}</td>
                                <td>${{$product->price}}</td>
                                <td>{{$product->type}}</td>
                                <td><a href="{{route('adminEditProductImageForm',['id'=>$product['id']])}}}" class="btn btn-info">Edit Image</a></td>
                                <td><a href="{{route('adminEditProductForm',['id'=>$product['id']])}}" class="btn btn-primary">Edit</a></td>
                                <td><a href="{{route('adminDeleteProduct',['id'=>$product['id']])}}" class="btn btn-danger">Delete</a></td>


                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                <div class="mb-5">
                    {{$products->links()}}

                </div>


                <form action="/admin/addProductForm" method="post" enctype="multipart/form-data">
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
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="product_name"  required>
                                    </div>

                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" class="form-control" name="description"  required>
                                    </div>

                                    <div class="form-group">
                                        <label>Type</label>
                                        <select class="form-control" name="product_type">
                                            <option value="Fruits">Fruits</option>
                                            <option value="Vegetables">Vegetables</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="text" class="form-control" name="price" placeholder="Product Price"  required>
                                    </div>

                                    <dic class="form-group">
                                        <label>Image</label>
                                        <input type="file" class="" name="image" id="image" placeholder="image" required>
                                    </dic>




                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

@endsection
