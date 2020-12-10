<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //

    public function index(){
//        $products = [0=>["name"=>"Apple","category"=>"Fruits","price"=>180],
//        1=>["name"=>"Apple","category"=>"Fruits","price"=>180],
//        2=>["name"=>"Apple","category"=>"Fruits","price"=>180]];
        $products = Product::all();

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



}
