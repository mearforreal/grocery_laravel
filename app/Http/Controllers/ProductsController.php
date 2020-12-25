<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Code;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //

    public function index(){

        $products = Product::all();
        //$products = Product::paginate(3);

        return view("allproducts",compact("products"));
    }

    public function fruitProducts(){
        $products = DB::table('products')->where('type', "Fruits")->get();
        return view("fruitProducts",compact("products"));
    }

    public function vegetablesProducts(){
        $products = DB::table('products')->where('type', "Vegetables")->get();
        return view("vegetablesProducts",compact("products"));
    }

    public function search(Request $request)
    {
       $searchText =  $request->get('searchText');
        $products= Product::where('name',"Like",$searchText."%")->paginate(3);
        return view("allproducts",compact("products"));
    }

    public function addProductToCart(Request $request,$id){

//        $request->session()->forget("cart");
//        $request->session()->fulsh();

        $prevCart = $request->session()->get('cart');
        $cart = new Cart($prevCart);

        $product = Product::find($id);
        $cart->addItem($id,$product);

        $request->session()->put('cart', $cart);

        return redirect()->route('allProducts');
    }

    public function incSingleProduct(Request $request,$id)
    {
        $prevCart = $request->session()->get('cart');
        $cart = new Cart($prevCart);
        $product = Product::find($id);
        $cart->addItem($id,$product);
        $request->session()->put('cart',$cart);

        return redirect()->route("cartproducts");

    }

    public function decSingleProduct(Request $request, $id)
    {
        $prevCart = $request->session()->get('cart');
        $cart = new Cart($prevCart);

        if($cart->items[$id]['quantity']>1){
            $product = Product::find($id);
            $cart->items[$id]['quantity'] = $cart->items[$id]['quantity']-1;
            $cart->items[$id]['totalSinglePrice'] = $cart->items[$id]['quantity'] * $product['price'];
            $cart->updatePriceAndQuantity();
            $request->session()->put('cart',$cart);
        }

        return redirect()->route("cartproducts");

    }


    public function showCart(){
//
        $cart = Session::get('cart');
        //cart is not empty
        if($cart){
            return view('cartproducts',['cartItems'=> $cart]);
        }else{
           return redirect()->route('allProducts');
        }
    }

    public function deleteItemFromCart(Request $request,$id){
        $cart = $request->session()->get("cart");
        if (array_key_exists($id,$cart->items)){
            unset($cart->items[$id]);
        }
        $oldCart = $request->session()->get("cart");
        $updateCart = new Cart($oldCart);
        $updateCart->updatePriceAndQuantity();
        $request->session()->put("cart",$updateCart);

        return redirect()->route('cartproducts');


    }

    //flag
    protected function createOrder(Request $request )
    {

        $cart = Session::get('cart');

        /*$codeArr = Code::all();
        $codes = DB::table('codes')->where('code', "$code")->get();*/

        if ($cart){
            $date = date('Y-m-d H:i:s');
//            $code= $request->coupon;
            $code=$_POST['coupon'];
            $tel = $request->input('telephone');
            $address = $request->input('address');
            $fullName = $request->input('fullName');
            echo $code;

            $codeId = 0;
            $priceCode = 1;
            $orderPrice = 0;
            if($code == null){
                $codeId = 1;
                $priceCode = 1;
                $orderPrice = $cart->totalPrice;
            }else{

                $codeGet = DB::table('codes')->where('code', $code)->get();
               $codeId = $codeGet[0]->id;
                $priceCode = $codeGet[0]->code_percentage;
                $orderPrice = $cart->totalPrice-($cart->totalPrice*$priceCode);
            }



            $newOrderArray = array("status"=>"on_hold","date"=>$date,"del_date"=>$date,
                "price"=>$orderPrice,"code_id"=>$codeId,
                "full_name"=>$fullName,"address"=>$address,"telephone" =>$tel);
            $created_order = DB::table("orders")->insert($newOrderArray);
            $order_id = DB::getPdo()->lastInsertId();

            foreach ($cart->items as $cart_item){

                $item_id = $cart_item['data']['id'];
                $item_name = $cart_item['data']['name'];
                $item_price = $cart_item['data']['price'];
                $newItemsCurrOrd = array("item_id"=>$item_id,"order_id"=>$order_id,"item_name"=>$item_name,"item_price"=>$item_price);
                $created_order_items = DB::table("order_items")->insert($newItemsCurrOrd);
            }
            //clear cart
            Session::forget("cart");
            //Session::flush();
            return redirect()->route("allProducts")->withsuccess("Thanks for using our product");
        }
        else{
            return redirect()->route("allProducts");
        }
    }

    public function checkoutProducts()
    {
        return view('checkoutproducts');
    }


}
