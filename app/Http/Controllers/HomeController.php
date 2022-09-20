<?php

namespace App\Http\Controllers;

use App\Models\crud;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = crud::get();
        return view('home' ,compact('data'));
    }
    public function forceLogin()
    {
        return view('auth.login');
    }
}
