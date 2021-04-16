<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Images;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddController extends Controller
{
    public function index(){
        return view('add.index');
    }
    public function enter_telephone(Request $req){
        $id = Auth::user()->id;
        $account1 = Account::where('user_id', $id)->get();
        if (count($account1) > 0) {
            Account::where('user_id', $id)->update([
                'country' => $req->country,
                'sity' => $req->sity,
                'age' => $req->age,
                'gender' => $req->gender,
                'about' => $req->about,
                'phone' => $req->phone,
            ]);

        } else {
            $acc = new Account;
            $acc->country = $req->country;
            $acc->sity = $req->sity;
            $acc->age = $req->age;
            $acc->gender = $req->gender;
            $acc->about = $req->about;
            $acc->phone = $req->phone;
            $acc->user_id = $id;
            $acc->save();
        }
        return redirect(route('skip'));
    }
    public function skip(){
        return view('add.image');
    }
    public function enter_image(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $id = Auth::user()->id;
        $account1 = Account::where('user_id', $id)->get();
        if (count($account1) > 0) {
            Account::where('user_id', $id)->update([
                'avatar' => $imageName
            ]);
            $i = new Images;
            $i->name = $imageName;
            $i->user_id = $id;
            $i->save();

        } else {

            $acc = new Account;
            $acc->avatar = $imageName;
            $acc->user_id = $id;
            $acc->save();
            $i = new Images;
            $i->name = $imageName;
            $i->user_id = $id;
            $i->save();
        }
        return redirect(route('verification.notice'));
    }
}
