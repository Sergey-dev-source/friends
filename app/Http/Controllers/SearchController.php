<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class SearchController extends Controller
{
    public function search(Request $request){
    	if (!empty($request->val)) {
    		$users = User::where('name','LIKE',$request->val."%")->with('accounts')->get();

    		return response()->json($users);
    	}else{
    		return response()->json('');
    	}
    }
}
