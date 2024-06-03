<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Personal_infor_Controller extends Controller
{
    public function index(){
        return view('pages.personal_infor');
    }
}
