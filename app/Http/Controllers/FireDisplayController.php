<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileDisplayController extends Controller
{
    public function index(Request $request)
    {
        $fileURL = $request->query('fileURL');
        $fileType = $request->query('fileType');
        $fileName = $request->query('fileName');

        return view('pages.thanhtoan.fileDisplay', compact('fileURL', 'fileType', 'fileName'));
    }
}