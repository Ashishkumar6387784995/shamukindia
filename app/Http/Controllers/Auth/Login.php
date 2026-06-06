<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Login extends Controller
{
  public function index()
  {
    if(Auth::check()){
      return redirect('/dashboard');
    }
    return view('auth.login');
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(),[
      'value' => 'required',
      'password' => 'required',
    ]);

    if($validator->fails()){
      return redirect()->back()->withErrors($validator)->withInput();
    }

    try {
      $user = User::where('email', $request->value)->orWhere('mobile_number', $request->value)->first();

      if (!$user) {
        return redirect()->back()->with('error', 'We dont have account with us, request you to please signup.');
      }

      if(!Hash::check($request->password, $user->password)){
        return redirect()->back()->with('error', 'Please enter correct password.');
      }
      
      Auth::login($user);

      if($user->role_id === 3){
        return redirect('/leads/index')->with('success', 'Login Successfully');
      }
      return redirect('/dashboard')->with('success', 'Login Successfully');
      
    } catch (\Exception $e) {
      return redirect()->back()->with('error', $e->getMessage());
    }
  }

  public function logout(){
    Auth::logout();
    return redirect('/login');
  }
}
