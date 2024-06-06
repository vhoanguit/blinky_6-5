<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session; 
use Illuminate\Support\Facades\Redirect; 

session_start();

class FavouriteController extends Controller
{
    public function getFavoritesByCustomer()
    {
    $customerId = Session::get('customer_id');

    if (!$customerId) {
        return view('pages.yeuthich.FavouriteProduct')->with('favorites', []);
    }
    
    // Kiểm tra xem customer_id có tồn tại trong bảng tbl_customers hay không
    $customer = DB::table('tbl_customers')->where('customer_id', $customerId)->first();
    if (!$customer) {
        Session::forget('customer_id'); // Xóa session nếu customer_id không hợp lệ
        return redirect('/login')->with('error_login', 'Thông tin đăng nhập không hợp lệ. Vui lòng đăng nhập lại.');
    }

    // Lấy thông tin sản phẩm yêu thích từ bảng tbl_favorite và tham gia với bảng tbl_product_details và tbl_product
    $favorites = DB::table('tbl_favorite')
        ->where('tbl_favorite.customer_id', $customerId)
        ->join('tbl_product', 'tbl_favorite.product_id', '=', 'tbl_product.product_id')
        ->select('tbl_product.*', 'tbl_favorite.created_at as favorite_created_at', 'tbl_favorite.updated_at as favorite_updated_at')
        ->get();

    // Lấy danh sách các size của tất cả sản phẩm yêu thích
    $sizes = [];
    foreach ($favorites as $favorite) {
        $sizes[$favorite->product_id] = DB::table('tbl_product_details')
            ->join('tbl_size', 'tbl_product_details.size_id', '=', 'tbl_size.size_id')
            ->where('tbl_product_details.product_id', $favorite->product_id)
            ->select('tbl_size.size_id', 'tbl_size.size_value', 'tbl_product_details.SL')
            ->get();
    }

    return view('pages.yeuthich.FavouriteProduct')
        ->with('favorites', $favorites)
        ->with('sizes', $sizes);
    }

    private function getSizesByProduct($productId)
    {
        return DB::table('tbl_size')
            ->join('tbl_product_details', 'tbl_size.size_id', '=', 'tbl_product_details.size_id')
            ->where('tbl_product_details.product_id', $productId)
            ->select('tbl_size.size_id', 'tbl_size.size_value', 'tbl_product_details.SL')
            ->get();
    }

    public function removeFavorite(Request $request)
    {
        $productId = $request->input('product_id');
        $customerId = Session::get('customer_id');

        DB::table('tbl_favorite')
            ->where('product_id', $productId)
            ->where('customer_id', $customerId)
            ->delete();

        return response()->json(['success' => true, 'message' => 'Đã xóa sản phẩm yêu thích']);
    }
    // public function getFavoritesByCustomer()
    // {
    //     // Lấy danh sách sản phẩm yêu thích của khách hàng có customer_id = 1
    //     $favorites = DB::table('tbl_favorite')
    //         ->where('customer_id', 1)
    //         ->join('tbl_product', 'tbl_favorite.product_id', '=', 'tbl_product.product_id')
    //         ->get();

    //     // Lấy danh sách các size của tất cả sản phẩm yêu thích
    //     $sizes = [];
    //     foreach ($favorites as $favorite) {
    //         $sizes[$favorite->product_id] = $this->getSizesByProduct($favorite->product_id);
    //     }

    //     return view('pages.favourite.FavouriteProduct')
    //         ->with('favorites', $favorites)
    //         ->with('sizes', $sizes);
    // }

    // private function getSizesByProduct($productId)
    // {
    //     return DB::table('tbl_size')
    //         ->join('tbl_product_details', 'tbl_size.size_id', '=', 'tbl_product_details.size_id')
    //         ->where('tbl_product_details.product_id', $productId)
    //         ->select('tbl_size.size_id', 'tbl_size.size_value', 'tbl_product_details.SL')  // Include the SL column
    //         ->get();
    // }

    // public function removeFavorite(Request $request)
    // {
    // $productId = $request->input('product_id');
    // $customerId = 1; // Assuming customer_id is 1, you should replace it with the actual customer_id

    // // Xóa sản phẩm khỏi bảng tbl_favorite
    // DB::table('tbl_favorite')
    //     ->where('product_id', $productId)
    //     ->where('customer_id', $customerId)
    //     ->delete();

    // return response()->json(['success' => true, 'message' => 'Đã xóa sản phẩm yêu thích']);
    // }

} 