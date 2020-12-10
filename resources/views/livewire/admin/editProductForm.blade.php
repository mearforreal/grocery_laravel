@extends('layouts.admin')

@section('main')

    <div class="row mt-5">
        <div class="col-sm-6 offset-3">
            <form action="/admin/updateProduct/{{$product->id}}" method="post">
                {{csrf_field()}}

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="product_name" value="{{$product->name}}" required>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <input type="text" class="form-control" name="description"  value="{{$product->description}}" required>
                </div>

                <div class="form-group">
                    <label>Type</label>
                    <input type="text" class="form-control" name="product_type"  value="{{$product->type}}" required>
                </div>

                <div class="form-group">
                    <label>Price</label>
                    <input type="text" class="form-control" name="price" placeholder="Product Name" value="{{$product->price}}" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>


            </form>
        </div>

    </div>



@endsection
