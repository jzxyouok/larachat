<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LRedis;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $redis;
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \Illuminate\Support\Facades\Redis::publish('rooms', json_encode(['room' => 'default_room']));
        return view('home');
    }
}
