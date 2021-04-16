<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Images;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccauntController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $account = Account::with('user')->where('user_id', $id)->first();
        return view('account.account', compact('account'));

    }

    public function edit(Request $req)
    {
        $id = Auth::user()->id;
        if(!empty($req->image)){
            $req->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imageName = time().'.'.$req->image->extension();
            $req->image->move(public_path('images'), $imageName);
            $img = new Images;
            $img->name = $imageName;
            $img->user_id = $id;
            $img->save();
        }


        $account1 = Account::where('user_id', $id)->get();

        if (count($account1) > 0) {
            if(empty($imageName)){
                Account::where('user_id', $id)->update([
                    'country' => $req->country,
                    'sity' => $req->sity,
                    'age' => $req->age,
                    'gender' => $req->gender,
                    'about' => $req->about,
                    'phone' => $req->phone,
                ]);
            }else{
                Account::where('user_id', $id)->update([
                    'country' => $req->country,
                    'sity' => $req->sity,
                    'age' => $req->age,
                    'gender' => $req->gender,
                    'about' => $req->about,
                    'phone' => $req->phone,
                    'avatar' => $imageName,
                ]);
            }
        } else {
            $acc = new Account;
            $acc->country = $req->country;
            $acc->sity = $req->sity;
            $acc->age = $req->age;
            $acc->gender = $req->gender;
            $acc->about = $req->about;
            $acc->phone = $req->phone;
            if(!empty($imageName)){
                $req->avatar = $imageName;
            }
            $acc->user_id = $id;
            $acc->save();
        }
        return redirect()->back();
    }
}
