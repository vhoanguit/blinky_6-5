<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderDetailsMail;

class OrderController extends Controller
{
    public function hoaDon()
    {
        $id = Session::get('id');
        $order = DB::table('hoadon_vanglai')->where('MaHDVL', $id)->first();

        if (!$order) {
            // Nếu không tìm thấy đơn hàng, bạn có thể điều hướng đến một trang lỗi hoặc hiển thị một thông báo.
            return redirect()->route('thanh_toan')->with('error', 'Không tìm thấy hóa đơn.');
        }

        return view('pages.thanhtoan.hoa_don', ['order' => $order]);
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

        // Lấy tên tỉnh
        $tinh = DB::table('TINH')->where('MaTinh', $province)->value('TenTinh');
        // Lấy tên huyện
        $huyen = DB::table('HUYEN')->where('MaHuyen', $district)->value('TenHuyen');

        return view('pages.thanhtoan.thanh_toan', compact('hoten', 'email', 'sdt', 'province', 'district', 'address', 'apartment', 'note', 'file', 'tinh', 'huyen'));
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

    public function online_checkout()
    {
        if (isset ($_POST['cod'])){

        }else if(isset ($_POST['payUrl'])){
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
            $orderInfo = "Thanh toán qua MoMo";
            $amount = "10000";
            $orderId = time() ."";
            $redirectUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";//trả về trang khi thanh toán thành công
            $ipnUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
            $extraData = "";
                $partnerCode = $partnerCode;
                $accessKey = $accessKey;
                $serectkey = $secretKey;
                $orderId = $orderId; // Mã đơn hàng
                $orderInfo = $orderInfo;
                $amount = $amount;
                $ipnUrl = $ipnUrl;
                $redirectUrl = $redirectUrl;
                $extraData = $extraData;
            
                $requestId = time() . "";
                $requestType = "payWithATM";
                $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
                //before sign HMAC SHA256 signature
                $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                $signature = hash_hmac("sha256", $rawHash, $serectkey);
                $data = array('partnerCode' => $partnerCode,
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
                    'signature' => $signature);
                $result = $this->execPostRequest($endpoint, json_encode($data));
                $jsonResult = json_decode($result, true);  // decode json
            
                //Just a example, please check more in there
            
                header('Location: ' . $jsonResult['payUrl']);
            
        }else if(isset ($_POST['vnpay'])){

        }
    }

    public function submitThanhToan(Request $request)
    {
        $hoten = Session::get('name', '');
        $email = Session::get('email', '');
        $sdt = Session::get('phone_num', '');
        $province = Session::get('province', '');
        $district = Session::get('district', '');
        $address = Session::get('address', '');
        $apartment = Session::get('apartment', '');
        $note = Session::get('note', '') ?? ''; // Đặt giá trị mặc định là chuỗi rỗng nếu $note là null
        $file = Session::get('file_input', '');
        $pttt = $request->input('pttt');
        $huyen = DB::table('HUYEN')->where('MaHuyen', $district)->value('TenHuyen');
        $tinh = DB::table('TINH')->where('MaTinh', $province)->value('TenTinh');
        $triGia = 0;

        $date = now();

        // Generate random ID with format HDVLxxxxxx
        function generateRandomId($length = 6)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = 'HDVL';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $id = generateRandomId();
        $fullAddress = ($apartment ? $apartment . ', ' . $address : $address) . ', ' . $huyen . ', ' . $tinh;

        DB::table('hoadon_vanglai')->insert([
            'MaHDVL' => $id,
            'TenKH' => $hoten,
            'Email' => $email,
            'SDT' => $sdt,
            'DiaChi' => $fullAddress,
            'Note' => $note ?: '', // Đảm bảo rằng Note không bao giờ là null
            'File' => $file ?: '',
            'TriGia' => $triGia,
            'NgDH' => $date,
            'PTTT' => $pttt,
        ]);

        // Lưu ID vào session
        Session::put('id', $id);

        // Gửi email xác nhận đơn hàng
        $order = DB::table('hoadon_vanglai')->where('MaHDVL', $id)->first();
        Mail::to($email)->send(new OrderDetailsMail($order));

        return redirect()->route('hoa_don');
    }
}