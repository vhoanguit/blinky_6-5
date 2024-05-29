<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; // sử dụng database
use App\Http\Requests;
use Session; // thu vien sdung session
use Illuminate\Support\Facades\Redirect; 
session_start();

class CartController extends Controller
{
    //
    public function shopping_cart()
    {
        // $this->AuthLogin();
        // $category_product=DB::table('tbl_category_product')->orderby('category_id','asc')->get();
        // $size=DB::table('tbl_size')->orderby('size_id','asc')->get();

        return view('pages.cart.ShoppingCart');
        //->with('category_product', $category_product)->with('size', $size);
    }
    // public function addToCart(Request $request)
    // {
    //     $productId = $request->product_id;
    //     $quantity = $request->quantity;
    //     $size = $request->size;
    //     $name = $request->name;
    //     $price = $request->price;

    //     $cart = Session::get('cart', []);

    //     if (isset($cart[$productId])) {
    //         $cart[$productId]['quantity'] += $quantity;
    //     } else {
    //         $cart[$productId] = [
    //             'product_id' => $productId,
    //             'quantity' => $quantity,
    //             'size' => $size,
    //             'name' => $name,
    //             'price' => $price
    //         ];
    //     }

    //     Session::put('cart', $cart);

    //     return response()->json(['success' => true, 'message' => 'Thêm vào giỏ hàng thành công']);
    // }
    public function addToCart(Request $request)
{
    $data = $request->all();
    $session_id = substr(md5(microtime()),rand(0,26),5);
    $cart = Session::get('cart');
    
    if($cart==true){
        $is_avaiable = 0;
        foreach($cart as $key => $val){
            if($val['product_id']==$data['cart_product_id']){
                $is_avaiable++;
                $cart[$key] = array(
                    'session_id' => $val['session_id'],
                    'product_name' => $val['product_name'],
                    'product_id' => $val['product_id'],
                    'product_image' => $val['product_image'],
                    'product_quantity' => $val['product_quantity'] + $data['cart_product_quantity'],
                    'product_price' => $val['product_price'],
                );
                Session::put('cart', $cart);
            }
        }
        if($is_avaiable == 0){
            $cart[] = array(
                'session_id' => $session_id,
                'product_id' => $data['cart_product_id'],
                'product_name' => $data['cart_product_name'],
                'product_image' => $data['cart_product_image'],
                'product_price' => $data['cart_product_price'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_size' => $data['cart_product_size']
            );
            Session::put('cart', $cart);
        }
    }else{
        $cart[] = array(
            'session_id' => $session_id,
            'product_id' => $data['cart_product_id'],
            'product_name' => $data['cart_product_name'],
            'product_image' => $data['cart_product_image'],
            'product_price' => $data['cart_product_price'],
            'product_quantity' => $data['cart_product_quantity'],
            'product_size' => $data['cart_product_size']
        );
        Session::put('cart', $cart);
    }

    // Trả về kết quả thành công
    return response()->json(['success' => true, 'message' => 'Thêm vào giỏ hàng thành công']);
}

}
