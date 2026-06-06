<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Register extends Controller
{
  public function index()
  {
    if (Auth::check()) {
      return redirect('/dashboard');
    }
    return view('auth.register');
  }

  public function store(Request $request)
  {
    try {
      $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|unique:users,email|email',
        'mobile_number' => 'required|numeric|unique:users,mobile_number|min:10',
        'password' => 'required|confirmed|string|min:8',
      ]);

      if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput()->with('error', 'User Registration Failed');
      }

      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->mobile_number = $request->mobile_number;
      $user->password = Hash::make($request->password);
      $user->pass_view = $request->password;
      $user->role_id = 4;
      $user->save();

      return redirect()->route('login')->with('success', 'User Registered Successfully');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', $e->getMessage());
    }
  }
}
