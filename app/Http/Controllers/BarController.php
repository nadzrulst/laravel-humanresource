<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class BarController extends Controller
{
    public function bar(){
        return view('das');
    }


    public function index ()
    {
        return view('dashboard.index');

    }
}
