<?php

namespace App\Http\Controllers;

class WebController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function login()
    {
        return view('login');
    }
}
