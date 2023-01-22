<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenInfoController extends Controller
{
    public function tc()
    {
        return view('gen_info.tc');
    }

    public function faq()
    {
        return view('gen_info.faq');
    }
}
