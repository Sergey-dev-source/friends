<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    public function index(){
        $id = Auth::user()->id;
        $images = Images::where('user_id',$id)->get();
        return view('account.image',compact('images',$images));
    }

    public function add(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $id = Auth::user()->id;
        $image = new Images;
        $image->name = $imageName;
        $image->user_id = $id;
        $image->save();
        return redirect()->back();

    }

    public function sel_avatar(Request $req){
        $id = Auth::user()->id;
        Account::where('user_id', $id)->update([
            'avatar' => $req->i,
        ]);
        return redirect()->back();
    }
}
