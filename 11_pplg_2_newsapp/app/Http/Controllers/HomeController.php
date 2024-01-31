<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('welcome'); //menampilkan tampilan home
    }
    public function signin(){
        return view('signin');
    }
    public function signup(){
        return view('signup');
    }
    public function profil(){
        return view('profil');
    }
}