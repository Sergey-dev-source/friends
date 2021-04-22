<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function get(){
        $contacts = User::where('id','!=',Auth::id())->get();
        return response()->json($contacts);
    }

    public function create(Request $request){
        $message = new Message;
        $message->from = $request->user_id;
        $message->to = $request->contact_id;
        $message->message = $request->message;
        $message->save();
        return response()->json($message);
    }
}
