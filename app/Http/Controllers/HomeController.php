<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Events\Write;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $unreadIds = Message::select(\DB::raw('`from` as sender_id,count(`from`) as messages_count'))
            ->where('to',Auth::id())
            ->where('read',false)
            ->groupBy('from')

            ->get();

        $contacts = $contacts->map(function ($contact) use ($unreadIds){
            $contactUnread = $unreadIds->where('sender_id',$contact->id)->first();
            $contact->unread = $contactUnread ? $contactUnread->messages_count: 0;
            return $contact;
        });

        return response()->json($contacts);
    }

    public function create(Request $request)
    {
        $message = Message::create([
            'from'=>Auth::id(),
            'to'=> $request->contact_id,
            'message'=> $request->message
        ]);

        broadcast(new NewMessage($message));
        return response()->json($message);
    }

    public function getMessage($id)
    {
        $message = Message::where('from',Auth::id())->where('to',$id)->orWhere('from',$id)->where('to',Auth::id())->get();

        return response()->json($message);
    }

    public function write(Request $request){
        broadcast( new Write($request->a,$request->b));
        return response()->json($request->a);
    }
}
