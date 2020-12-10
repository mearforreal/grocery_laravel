@extends('layouts.admin')

@section('main')


    <div class="table-responsive">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    <li>
                        {{!! print_r($errors->all())}}
                    </li>
                </ul>
            </div>
            @endif

        <h3>Current Image</h3>
            <div><img src="{{Storage::disk('local')->url('product_images/'.$product->image)}}" alt="" style="width: 400px"></div>
            <form action="/admin/updateProductImage/{{$product->id}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <dic class="form-group">
                    <label>Update Image</label>
                    <input type="file" class="form-control" name="image" id="image" placeholder="image" value="{{$product->image}}" required>
                </dic>

                <button type="submit" name="submit" class="btn btn-primary">Submit</button>


            </form>

    </div>

@endsection
