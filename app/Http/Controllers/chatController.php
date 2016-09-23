<?php

namespace App\Http\Controllers;

use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use LRedis;
use App\Messages;
use App\User;

use App\Http\Requests;

class chatController extends Controller
{
    protected $redis;
    public function __construct()
    {
        $this->middleware('auth');
        $this->redis = LRedis::connection();
    }

    public function sendMessage(Request $request)
    {
        $Messages = new Messages();
        $Messages->id = Uuid::uuid();
        $Messages->user_id = Auth::user()->id;
        $Messages->data = $request->input('message');
        $Messages->status = false;
        $Messages->save();
//        dd($Messages);

        $data = [
            'message' => $request->input('message'),
            'user' => $request->input('user'),
            'datetime' => date("h:i:a"),
        ];

        $this->redis->publish('message', json_encode($data));
        return response()->json([]);
    }

    public function getMessage(Request $request)
    {
        $datas = null;
        $this->redis->publish('getMessage', json_encode($datas));
//        dd($redis);
        return response()->json([]);
    }

    public function isonline($id = null)
    {
        $users = App\User::findOrFail($id);
        dd($users);
    }
}
