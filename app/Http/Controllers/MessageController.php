<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use App\Models\Messeges;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index($id){
        $to = count(Contacts::where('from',Auth::id())->where('to',$id)->get());

        if ($to == 0){
            $contact = new Contacts;
            $contact->from = Auth::id();
            $contact->to = $id;
            $contact->save();
        }
        $cont = User::where('id',$id)->first();
        $mess = Messeges::where('from',Auth::id())->orWhere('to',Auth::id())->get();
        return view('chat.contact',compact(['cont','mess']));
    }

    public function create_chat(Request $request){
        $id = Auth::id();
        if (!empty($request->image)){
            $imageName = '/images/chats/' . time().'.'.$request->image->extension();
            $request->image->move(public_path('images/chats'), $imageName);
        }else{
            $imageName = '';
        }

        $mess = new Messeges;
        $mess->from = $id;
        $mess->to = $request->to;
        $mess->message_file = $imageName;
        $mess->message = $request->message;
        $mess->save();
        return redirect()->back();
    }

    public function chat($id){
//        $from = Contacts::where('from',Auth::id())->get();
//        $data = [];
//        foreach ($from as $f){
//            $data[] = $f->to;
//        }

    }
}
