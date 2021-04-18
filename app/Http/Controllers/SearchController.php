<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request){
    	if (!empty($request->val)) {
    		$users = User::where('name','LIKE',$request->val."%")->where('id','!=',Auth::id())->with('accounts')->get();

    		return response()->json($users);
    	}else{
    		return response()->json('');
    	}
    }
}
