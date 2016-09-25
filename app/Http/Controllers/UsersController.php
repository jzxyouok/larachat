<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class UsersController extends Controller
{
    public function setRoom(Request $request)
    {
        $user = Auth::user();
//        $user->setRoom($request->get('room'));
        Redis::publish('room', $request->get('room'));
    }


    public function getUser()
    {
        return Auth::user();
    }
}
