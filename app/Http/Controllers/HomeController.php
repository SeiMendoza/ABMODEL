<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view("index");
    }

    public function b(){
        return view("pages.billing");
    }

    public function t(){
        return view("pages.tables");
    }

    public function admonRestaurante(){
        return view("/Menu/Admon/admon_Restaurante");
    }

    public function p(){
        return view("pages.profile");
    }

    public function s(){
        return view("pages.sign-in");
    }

    public function r(){
        return view("pages.rtl");
    }
    public function registro(){
        return view("pages.registro");
    }
}
