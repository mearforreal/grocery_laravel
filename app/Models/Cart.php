<?php


namespace App\Models;


use http\Env\Request;

class Cart
{
    public $items; // ['id'=>['quantity' =>, 'price' => , 'data'=.]
    public $totalQuantity;
    public $totalPrice;

    /**
     * Cart constructor.
     */
    public function __construct($prevCart)
    {
        if($prevCart != null){
            $this->items = $prevCart->items;
            $this->totalQuantity = $prevCart->totalQuantity;
            $this->totalPrice = $prevCart->totalPrice;
        }else{
            $this->items = [];
            $this->totalQuantity = 0;
            $this->totalPrice = 0;

        }
    }

    public function addItem($id,$product){
        $price = (double)str_replace("$","",$product->price);



        //the item already existes
        if(array_key_exists($id,$this->items)){
            $productToAdd = $this->items[$id];
            $productToAdd['quantity']++;
            $productToAdd['totalSinglePrice'] = $productToAdd['quantity'] * $price;


        }else{//first time add item to cart
            $productToAdd = ['quantity'=> 1, 'totalSinglePrice' => $price, 'data' => $product];
        }

        $this->items[$id] = $productToAdd;
        $this->totalQuantity++;
        $this->totalPrice = $this->totalPrice + $price;

    }



    public function updatePriceAndQuantity(){

        $totalPrice = 0;
        $totalQuantity = 0;

        foreach ($this->items as $item){

            $totalQuantity = $totalQuantity + $item['quantity'];
            $totalPrice = $totalPrice + $item['totalSinglePrice'];
        }

        $this->totalPrice = $totalPrice;
        $this->totalQuantity = $totalQuantity;

    }
}
