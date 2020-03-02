<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Login;
class LoginController extends Controller
{
    public function login(){
    	return view('login.login');
    }
    public function logindo(Request $request){
    	$data=$request->except('_token');
    	$data['password']=md5($data['password']);
    	$user=Login::where($data)->first();
    	if($user){
    		session(['user'=>$user]);
    		$request->session()->save();
    		return redirect('/cate/list');
    	}
    	return redirect('/login')->with('msg','没有此用户');
    }
}
