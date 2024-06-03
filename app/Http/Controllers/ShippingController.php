<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ShippingController extends Controller
{
    public function index()
    {
        $provinces = DB::table('tinh')->get();
        return view('pages.thanhtoan.shipping', compact('provinces'));
    }

    public function fetchDistrict(Request $request)
    {
        Log::info('Received AJAX request', ['province' => $request->province]);

        if ($request->ajax()) {
            $districts = DB::table('huyen')->where('MaTinh', $request->province)->get();
            $response = '<option value="">Chọn quận, huyện</option>';
            foreach ($districts as $district) {
                $response .= '<option value="' . $district->MaHuyen . '">' . $district->TenHuyen . '</option>';
            }
            return response($response);
        }
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone_num' => 'required|regex:/(0)[0-9]{9}/',
        'province' => 'required|string|max:255',
        'district' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'apartment' => 'nullable|string|max:255',
    ]);

    session([
        'name' => $request->name,
        'email' => $request->email,
        'phone_num' => $request->phone_num,
        'province' => $request->province,
        'district' => $request->district,
        'address' => $request->address,
        'apartment' => $request->apartment,
    ]);

    return redirect()->route('bo-sung.index');  // Chuyển hướng đến trang bổ sung
}

}