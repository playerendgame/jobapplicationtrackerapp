<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){

        return view('loginandregister');

    }

    public function dashboard(){

        return view('dashboard');

    }

}
