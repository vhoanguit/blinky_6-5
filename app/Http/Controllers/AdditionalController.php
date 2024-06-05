<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdditionalController extends Controller
{
    //
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
    $new_file = null;

    if ($request->hasFile('file_input')) {
        $get_file = $request->file('file_input');

        if ($get_file) {
            $get_name_file = $get_file->getClientOriginalName();
            $name_file = pathinfo($get_name_file, PATHINFO_FILENAME); // Get the filename without extension
            $new_file = $name_file . rand(0, 1000) . '.' . $get_file->getClientOriginalExtension();
            
            $get_file->move('public/uploads/additinal',$new_file);
            // $get_file->move(public_path('uploads/additional'), $new_file);
            // $filePath = 'uploads/additional/' . $new_file; // Store relative path
        }
    }

    session([
        'note' => $note,
        'file_input' => $new_file,
    ]);

    return redirect()->route('thanh_toan'); // Redirect to the payment page
}


    public function fileDisplay()
    {
        return view('pages.thanhtoan.fileDisplay');
    }
}