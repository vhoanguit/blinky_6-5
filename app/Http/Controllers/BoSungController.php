<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BoSungController extends Controller
{
    public function index()
    {
        return view('pages.thanhtoan.bo_sung');
    }

    public function store(Request $request)
    {
        $request->validate([
            'mo_ta' => 'nullable|string',
            'file_input' => 'nullable|file|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        $note = $request->input('mo_ta');
        $filePath = null;

        if ($request->hasFile('file_input')) {
            $file = $request->file('file_input');
            $filePath = $file->store('uploads', 'public');
        }

        session([
            'note' => $note,
            'file_input' => $filePath,
        ]);

        return redirect()->route('thanh_toan');  // Chuyển hướng đến trang thanh toán
    }

    public function fileDisplay()
    {
        return view('pages.fileDisplay');
    }
}