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
            ->join('tbl_product_details', function ($join) {
                $join->on('tbl_cart.product_id', '=', 'tbl_product_details.product_id')
                     ->on('tbl_cart.size_id', '=', 'tbl_product_details.size_id');})
            
            ->join('tbl_product','tbl_product.product_id','=','tbl_cart.product_id')
            ->join('tbl_size','tbl_size.size_id','=','tbl_cart.size_id')
            
            ->orderBy('tbl_cart.updated_at', 'desc')
            ->get();

            return view('pages.cart.ShoppingCart')->with('login',$customer_id)->with('ShoppingCart',$cart);
        }
        else return view('pages.cart.ShoppingCart')->with('login',$customer_id);

    }
    public function addToCart(Request $request)
    {
        $data = $request->all();
        $customerId = Session::get('customer_id');

        // Lấy số lượng tồn kho của sản phẩm với kích cỡ cụ thể
        $productDetails = DB::table('tbl_product_details')
            ->where('product_id', $data['cart_product_id'])
            ->where('size_id', $data['cart_product_size'])
            ->first();

            if ($productDetails) {
                // Lấy số lượng hiện tại trong giỏ hàng
                $cartProductQuantity = $data['cart_product_quantity'];
                
                $existingCartProduct = DB::table('tbl_cart')
                    ->where('product_id', $data['cart_product_id'])
                    ->where('customer_id', $customerId)
                    ->where('size_id', $data['cart_product_size'])
                    ->first();
        
                if ($existingCartProduct) {
                    $cartProductQuantity += $existingCartProduct->cart_quantity;
                }
        
                if ($productDetails->SL >= $cartProductQuantity) {
                    // Cập nhật hoặc thêm mới sản phẩm vào giỏ hàng trong cơ sở dữ liệu
                    if ($existingCartProduct) {
                        DB::table('tbl_cart')
                            ->where('product_id', $data['cart_product_id'])
                            ->where('customer_id', $customerId)
                            ->where('size_id', $data['cart_product_size'])
                            ->update(['cart_quantity' => $cartProductQuantity]);
                    } else {
                        DB::table('tbl_cart')->insert([
                            'product_id' => $data['cart_product_id'],
                            'customer_id' => $customerId,
                            'size_id' => $data['cart_product_size'],
                            'cart_quantity' => $data['cart_product_quantity'],
                            'created_at' => now()
                        ]);
                    }
        
                    // Lưu vào session giỏ hàng
                    $session_id = substr(md5(microtime()), rand(0, 26), 5);
                    $cart = Session::get('cart');
        
                    if ($cart == true) {
                        $is_avaiable = 0;
                        foreach ($cart as $key => $val) {
                            if ($val['product_id'] == $data['cart_product_id'] && $val['product_size'] == $data['cart_product_size']) {
                                $is_avaiable++;
                                $cart[$key]['product_quantity'] = $cartProductQuantity;
                                Session::put('cart', $cart);
                            }
                        }
                        if ($is_avaiable == 0) {
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
                    } else {
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
        
                    return response()->json(['success' => true, 'message' => 'Thêm vào giỏ hàng thành công']);
                } else {
                    return response()->json(['success' => false, 'message' => 'Số lượng vượt quá tồn kho']);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại']);
            }   
    }
    public function add_shopping_cart(Request $request)
    {
        $customer = Session::get('customer_id');
        $product = $request->proid;
        $size = $request->prosize;
        $quantity = $request->proquantity;

        if ($customer)
        {
            $existingRecord = DB::table('tbl_cart')->where('product_id', $product)->where('size_id', $size)->where('customer_id', $customer)->first();
    
        if ($existingRecord === null) {
            //nếu rỗng->chưa có->thêm vào
            $data = [];
            $data['product_id'] = $product;
            $data['size_id'] = $size;
            $data['customer_id'] = $customer;
            $data['cart_quantity'] = $quantity;
            DB::table('tbl_cart')->insert($data);
        } else {
            //tức là đã có thì cộng dồn lên
            $inventory = DB::table('tbl_cart')
                ->join('tbl_product_details', function ($join) {
                    $join->on('tbl_cart.product_id', '=', 'tbl_product_details.product_id')->on('tbl_cart.size_id', '=', 'tbl_product_details.size_id');
                })
                ->where('tbl_cart.size_id', $size)
                ->where('tbl_cart.product_id', $product)
                ->pluck('SL')
                ->first();
    
            $new_quantity = $existingRecord->cart_quantity + $quantity;
            $new_quantity = min($new_quantity, $inventory); //nếu số lượng chọn lớn hơn tồn kho thì set=tồn kho
    
            DB::table('tbl_cart')
                ->where('product_id', $product)
                ->where('size_id', $size)
                ->where('customer_id', $customer)
                ->update(['cart_quantity' => $new_quantity]);
        }
        return response()->json(['success' => true]);
        }
        else {
            return response()->json(['success' => false, 'message' => 'Bạn cần đăng nhập trước!']);
        }

    }
    public function delete_cart(Request $request)
    {
        $customer = Session::get('customer_id');
        $product =  $request->proid;
        $size =  $request->prosize;
        $quantity =  $request->proquantity;

        DB::table('tbl_cart')->where('product_id', $product)->where('size_id', $size)->where('customer_id', $customer)->delete();
        return response()->json(['success' => true]);
    }
    public function update_cart(Request $request)
    {
        $customer = Session::get('customer_id');
        $product =  $request->proid;
        $size =  $request->prosize;
        $quantity =  $request->proquantity;

        DB::table('tbl_cart')
        ->where('product_id', $product)
        ->where('size_id', $size)
        ->where('customer_id', $customer)
        ->update(['cart_quantity' => $quantity]);

        return response()->json(['success' => true]);
    }
 
}