<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminProductsController extends Controller
{
    //
    public function index(){
        $products = Product::all();


        return view("livewire.admin.admin-dashboard-component",['products'=>$products])->layout('layouts.admin');
    }
    //display edit product form
    public function editProductForm($id){
        $product = Product::find($id);

        return view("livewire.admin.editProductForm",['product'=>$product]);
    }
    //display edit product image form
    public function editProductImageForm($id){
        $product = Product::find($id);
        return view("livewire.admin.editProductImageForm",['product'=>$product]);
    }

    //update product image
    public function updateProductImage(Request $request,$id){
        Validator::make($request->all(),['image'=>'required|image|mimes:jpg,png,jpeg|max:15000'])->validate();

        if($request->hasFile("image")){
            $product = Product::find($id);
           $exists = Storage::disk('local')->exists("public/product_images/".$product->image);

           //delete old image
           if ($exists){
               Storage::delete("public/product_images/".$product->image);
           }

           //upload new img
           $ext = $request->file('image')->getClientOriginalExtension(); //jpg

            $request->image->storeAs("public/product_images/",$product->image);
//
//            $arrToUpdate = array('image'=>$product->image);
//            DB::table('products')->where('id',$id)->update($arrToUpdate);

           return redirect()->route("admin.dashboard");
        }else{
            return "No image was chosen";
        }
    }


    public function updateProduct(Request $request,$id){

        $productName = $request->input('product_name');
        $description = $request->input('description');
        $productType = $request->input('product_type');
        $price = $request->input('price');

        $arrToUpdate = array("name"=>$productName,"description"=>$description,"type"=>$productType,"price"=>$price);

        DB::table('products')->where('id',$id)->update($arrToUpdate);

        return redirect()->route("admin.dashboard");

    }
//Add Product
    public function addProductForm(Request $request){
        Validator::make($request->all(),['image'=>'required|image|mimes:jpg,png,jpeg|max:15000'])->validate();

        $productName = $request->input('product_name');
        $description = $request->input('description');
        $productType = $request->input('product_type');
        $price = $request->input('price');

        $ext = $request->file('image')->getClientOriginalExtension(); //jpg
        $stringImageReformat = str_replace(" ","",$request->input('product_name'));

        $imageName = $stringImageReformat.".".$ext;//.jpg

//        $imgEncoded = File::get($request->image);
//        Storage::disk('local')->put('product_images/'.$imageName,$imgEncoded);
        $request->image->storeAs("public/product_images/",$imageName);


        $arrToInsert = array("name"=>$productName,"description"=>$description,"type"=>$productType,"price"=>$price,"image"=>$imageName);

        $added = DB::table('products')->insert($arrToInsert);


        $products = Product::all();


        return view("livewire.admin.admin-dashboard-component",['products'=>$products])->layout('layouts.admin');


    }

    //delete product
    public function deleteProduct($id){
        $product = Product::find($id);


        $exists = Storage::disk('local')->exists("public/product_images/".$product->image);

        //delete old image
        if ($exists){
            Storage::delete("public/product_images/".$product->image);
        }

        Product::destroy($id);

        return redirect()->route("admin.dashboard");

    }

    //display add user form
    public function addUserDisplay(){

        return view("livewire.admin.addUserForm");
    }

    //Add User
    public function addUserForm(Request $request){


        $userName = $request->input('user_name');
        $email = $request->input('email');

        $password = $request->input('password');

        $passwordHash = Hash::make($password);

        $role = $request->input('role');



        $arrToInsert = array("name"=>$userName,"email"=>$email,"password"=>$passwordHash,"utype"=>$role);

       DB::table('users')->insert($arrToInsert);


        return redirect()->route("admin.dashboard.userList");


    }

    public function userList(){
        $users = User::all();


        return view("livewire.admin.admin-user-dash",['users'=>$users])->layout('layouts.admin');
    }


//delete User
    public function deleteUser($id){
        $user = User::find($id);



        User::destroy($id);

        return redirect()->route("admin.dashboard.userList");

    }

    //display edit product form
    public function editUserForm($id){
        $user = User::find($id);

        return view("livewire.admin.editUserForm",['user'=>$user]);
    }
//update user
    public function updateUser(Request $request,$id){

        $userName = $request->input('user_name');
        $email= $request->input('email');
        $password = $request->input('password');
        $passwordHash = Hash::make($password);

        $role= $request->input('role');

        $arrToUpdate = array("name"=>$userName,"email"=>$email,"password"=>$passwordHash,"utype"=>$role);

        DB::table('users')->where('id',$id)->update($arrToUpdate);

        return redirect()->route("admin.dashboard.userList");

    }


}
