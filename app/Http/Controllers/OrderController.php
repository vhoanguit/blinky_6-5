<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderDetailsMail;

class OrderController extends Controller
{
    public function checkout()
    {
        view('checkout');
    }
    public function hoaDon()
    {
        $id = Session::get('id');
        $order = DB::table('tbl_customer_order')->where('order_id', $id)->first();
        $orderDetails = DB::table('tbl_order_details')->where('order_id', $id)->get();
        $customer = DB::table('tbl_customers')->where('customer_id', $order->customer_id)->first();

        if (!$order) {
            return redirect()->route('thanh_toan')->with('error', 'Không tìm thấy hóa đơn.');
        }

        return view('pages.hoa_don', [
            'order' => $order,
            'orderDetails' => $orderDetails,
            'customer' => $customer
        ]);
    }

    public function thanhToan()
    {
        $hoten = Session::get('name', '');
        $email = Session::get('email', '');
        $sdt = Session::get('phone_num', '');
        $province = Session::get('province', '');
        $district = Session::get('district', '');
        $address = Session::get('address', '');
        $apartment = Session::get('apartment', '');
        $note = Session::get('note', '');
        $file = Session::get('file_input', '');
    
        $tinh = DB::table('province')->where('province_id', $province)->value('province_name');
        $huyen = DB::table('district')->where('district_id', $district)->value('district_name');
    
        $cart = Session::get('cart', []); // Lấy giỏ hàng từ session, mặc định là một mảng rỗng nếu không có gì trong session
    
        // Tính tổng tiền
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['product_price'] * $item['product_quantity'];
        }
    
        return view('pages.thanhtoan.thanh_toan', compact('hoten', 'email', 'sdt', 'province', 'district', 'address', 'apartment', 'note', 'file', 'tinh', 'huyen', 'cart', 'total'));
    }
    


    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function momo_payment(Request $request)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua ATM MoMo";
        $amount = "10000";
        $orderId = time() ."";
        $redirectUrl = route('hoa_don');
        $ipnUrl = route('hoa_don');
        $extraData = "";

        $requestId = time() . "";
        $requestType = "payWithATM";
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "BLINKIY",
            "storeId" => "BLINKIY",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);

        return redirect()->to($jsonResult['payUrl']);
    }

    public function momoqr_payment(Request $request)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

        $orderInfo = "Thanh toán qua mã QR MoMo";
        $amount = "10000";
        $orderId = time() ."";
        $redirectUrl = route('hoa_don');
        $ipnUrl = route('hoa_don');
        $extraData = "";
        $requestId = time() . "";
        $requestType = "captureWallet";
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);

        return redirect()->to($jsonResult['payUrl']);
    }

    public function submitThanhToan(Request $request)
    {
        // Lấy thông tin từ session và request
        $hoten = Session::get('name', '');
        $email = Session::get('email', '');
        $sdt = Session::get('phone_num', '');
        $province = Session::get('province', '');
        $district = Session::get('district', '');
        $address = Session::get('address', '');
        $apartment = Session::get('apartment', '');
        $note = Session::get('note', '') ?? '';
        $file = Session::get('file_input', '');
        $pttt = $request->input('pttt');

        // Lấy tên tỉnh và huyện từ DB
        $tinh = DB::table('province')->where('province_id', $province)->value('province_name');
        $huyen = DB::table('district')->where('district_id', $district)->value('district_name');

        $cart = Session::get('cart', []); // Lấy giỏ hàng từ session

        // Tính tổng tiền
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['product_price'] * $item['product_quantity'];
        }

        // Tạo dữ liệu địa chỉ đầy đủ
        $fullAddress = ($apartment ? $apartment . ', ' . $address : $address) . ', ' . $huyen . ', ' . $tinh;

        // Tạo order mới trong bảng tbl_customer_order
        $orderId = DB::table('tbl_customer_order')->insertGetId([
            'customer_id' => '', // Ensure this is set correctly
            'customer_name' => $hoten,
            'customer_email' => $email,
            'customer_phone' => $sdt,
            'customer_address' => $fullAddress,
            'order_note' => $note,
            'order_files' => $file,
            'order_total_price' => $total,
            'order_date' => now(),
            'payment_opt' => $pttt,
            'order_status' => 'Pending',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        

        // Lưu chi tiết đơn hàng vào bảng tbl_order_details
        foreach ($cart as $item) {
            DB::table('tbl_order_details')->insert([
                'order_id' => $orderId,
                'product_id' => $item['product_id'],
                'product_quantity' => $item['product_quantity'],
                'product_price' => $item['product_price'],
                'total_price' => $item['product_price'] * $item['product_quantity'],
                'created_at' => now(),
                'updated_at' => now(),
                'size_id' => $item['size_id']
            ]);
        }
        

        // Lưu orderId vào session để dùng ở trang hóa đơn
        Session::put('id', $orderId);

        // Gửi email chi tiết đơn hàng
        $order = DB::table('tbl_customer_order')->where('order_id', $orderId)->first();
        Mail::to($email)->send(new OrderDetailsMail($order));

        // Xử lý chuyển hướng dựa trên phương thức thanh toán
        switch ($pttt) {
            case 1:
                return $this->momoqr_payment($request);
            case 2:
                return $this->momo_payment($request);
            case 3:
                return redirect()->route('hoa_don');
            default:
                return redirect()->route('thanh_toan')->with('error', 'Phương thức thanh toán không hợp lệ.');
        }
    }

}