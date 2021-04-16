<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Images;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        $users = Auth::user();
        return view('user.dashboard',compact('users'));
    }
    public function status(){
    	$id = Auth::user()->id;
    	$status = Status::where('user_id',$id)->get();
        return view('user.status',compact('status'));
    }

    public function stat(Request $request){
    	$id = Auth::user()->id;
    	$request->validate([
            'status' => 'required|min:6',
        ]);
        if (!empty($request->image)){
        	$request->validate([
            	'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        	]);
        	$imageName = '/images/status/' . time().'.'.$request->image->extension();
        	$request->image->move(public_path('images/status'), $imageName);
        }else{
        	$imageName = '';
        }
    	$status = new Status;
    	$status->status = $request->status;
    	$status->name = $imageName;
    	$status->user_id = $id;
    	$status->save();

    	return redirect()->back();
    }

    public function user($id)
    {
    	$user = User::where('id',$id)->first();
    	return view('user.user',compact('user'));
    }
}
