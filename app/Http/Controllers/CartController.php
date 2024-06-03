<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; // sử dụng database
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
// use Session; // thu vien sdung session
use Illuminate\Support\Facades\Redirect; 
session_start();

class CartController extends Controller
{
    //
    public function shopping_cart()
    {
        $customer_id = Session::get('customer_id');
      
        if($customer_id)
        {

            $cart=DB::table('tbl_cart')
            ->where('customer_id', $customer_id)
            ->join('tbl_product','tbl_product.product_id','=','tbl_cart.product_id')
            ->join('tbl_size','tbl_size.size_id','=','tbl_cart.size_id')
            ->join('tbl_product_details', function ($join) {
                $join->on('tbl_cart.product_id', '=', 'tbl_product_details.product_id')
                     ->on('tbl_cart.size_id', '=', 'tbl_product_details.size_id');})
            ->orderBy('tbl_cart.created_at', 'desc')
            ->get();

            return view('pages.cart.ShoppingCart')->with('login',$customer_id)->with('ShoppingCart',$cart);
        }
        else return view('pages.cart.ShoppingCart')->with('login',$customer_id);
        // $this->AuthLogin();
        // $category_product=DB::table('tbl_category_product')->orderby('category_id','asc')->get();
        // $size=DB::table('tbl_size')->orderby('size_id','asc')->get();

        
        //->with('category_product', $category_product)->with('size', $size);
    }
}