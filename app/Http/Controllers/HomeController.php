<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
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

    public function get()
    {
        $contacts = User::where('id', '!=', Auth::id())->get();
        return response()->json($contacts);
    }

    public function create(Request $request)
    {
        $message = new Message;
        $message->from = Auth::id();
        $message->to = $request->contact_id;
        $message->message = $request->message;
        $message->save();
        broadcast(new NewMessage($message))->toOthers();
        return response()->json($message);
    }

    public function getMessage($id)
    {
        $message = Message::where('from',Auth::id())->where('to',$id)->orWhere('from',$id)->where('to',Auth::id())->get();

        return response()->json($message);
    }
}
