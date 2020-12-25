
@extends('layouts.index')

@section('center')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                <tr class="cart_menu">

                    <td class="image">Item</td>
                    <td class="description"></td>
                    <td class="price">Price</td>
                    <td class="quantity">Quantity</td>
                    <td class="total">Total</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                @foreach($cartItems->items as $item)

                    <tr>


                        <td class="cart_product">
                            <a href=""><img src="{{Storage::disk('local')->url('product_images/'.$item['data']['image'])}}" width="100" height="100" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$item['data']['name']}}</a></h4>
                            <br>
                            <p>web-id: {{$item['data']['id']}}</p>
                        </td>
                        <td class="cart_price">
                            <p>${{$item['data']['price']}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href="{{route('incSingleProduct',['id'=>$item['data']['id']])}}"> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="{{$item['quantity']}}" autocomplete="off" size="2">
                                <a class="cart_quantity_down"  href="{{route('decSingleProduct',['id'=>$item['data']['id']])}}"> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{$item['totalSinglePrice']}}</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{route('DeleteItemFromCart',['id'=>$item['data']['id']])}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>

{{--                    <td class="active">{{$item['data']['id']}}</td>--}}
{{--                    <td class="active"> <img src="{{Storage::disk('local')->url('product_images/'.$item['data']['image'])}}" width="100" height="100"/></td>--}}
{{--                    <td class="active">{{$item['data']['name']}}</td>--}}


                @endforeach



                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container offset-6">

        <div class="row">
            <div class="col-sm-4">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="{{route('fruitProducts')}}">Fruits</a></h4>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="{{route('vegetablesProducts')}}">Vegetables</a></h4>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="#">Breads</a></h4>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="#">Oil</a></h4>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="#">Meat</a></h4>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="#">Eggs</a></h4>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="#">Condiments</a></h4>
                            </div>
                        </div>
                    </div><!--/category-products-->




                    {{--                        <div class="shipping text-center"><!--shipping-->--}}
                    {{--                            <img src="images/home/shipping.jpg" alt="" />--}}
                    {{--                        </div><!--/shipping-->--}}

                </div>
            </div>
            <div class="col-sm-2">
               {{-- <div class="img-rounded">
                <img src="https://images.pexels.com/photos/2733918/pexels-photo-2733918.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                </div>--}}
            </div>

            <div class="col-sm-6 ">
                <h3>What would you like to do next?</h3>
                <p>Enter if you have a discount code </p>
                <div class="total_area">
                    <ul>

                        <li>Quantity <span>{{$cartItems->totalQuantity}}</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span>${{$cartItems->totalPrice}}</span></li>
                    </ul>

                    <a class="btn btn-default check_out" href="#">Update</a>
                    <button type="button" class="btn btn-default check_out" data-toggle="modal" id="pay"  data-target="#staticBackdrop" style="float: right">
                        Checkout
                    </button>

                </div>
            </div>

        </div>
    </div>
</section><!--/#do_action-->


<form action="/product/createOrder" method="post">
    @csrf
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog justify-content-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        <i class="fa fa-cc-paypal" aria-hidden="true"></i>
                        <i class="fa fa-cc-mastercard" aria-hidden="true"></i>
                        <i class="fa fa-cc-visa" aria-hidden="true"></i>
                        <i class="fa fa-money" aria-hidden="true"></i>
                        <i class="fa fa-credit-card" aria-hidden="true"></i>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">

                        <label>Telephone<span style="color: red">*</span></label>
                        <input type="tel" class="form-control" name="telephone" required >
                    </div>
                    <div class="form-group">
                        <label>Full Name<span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="fullName" required>
                    </div>
                    <div class="form-group">
                        <label>Address<span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="address" required>
                    </div>
                    <div class="form-group">
                        <label>Coupon Code</label>
                        <input type="text" class="form-control" name="coupon" >
                    </div>


                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary" >Make order</button>

                </div>
            </div>
        </div>
    </div>
</form>


@endsection
