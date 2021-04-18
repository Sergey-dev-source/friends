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
        if ($id == Auth::id()){
            return redirect(route('dashboard'));
        }
        $to = count(Contacts::where('from',Auth::id())->where('to',$id)->get());

        if ($to == 0){
            $contact = new Contacts;
            $contact->from = Auth::id();
            $contact->to = $id;
            $contact->save();
        }
        $from = Contacts::where('from',Auth::id())->get();
        $data1 = [];
        foreach ($from as $f){
            $data1[] = $f->to;
        }
        $this->data['messages'] = Messeges::where('from','=',Auth::id())->where('to','=',$id)->orWhere('to','=',Auth::id())->where('from','=',$id)->get();
        $this->data['contacts'] = User::whereIn('id',$data1)->get();
        $this->data['cintactId'] = $id;
        return view('chat.contact',$this->data);
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

    public function chat(){
        $from = Contacts::where('from',Auth::id())->get();
        $data1 = [];
        foreach ($from as $f){
            $data1[] = $f->to;
        }
        $this->data['contacts'] = User::whereIn('id',$data1)->get();
        return view('chat.chats',$this->data);
    }
}
