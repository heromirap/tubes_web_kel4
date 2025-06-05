<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  public function index()
  {
    return view('auth.login');
  }

  public function authenticate(Request $request)
  {
    $credentials = $request->validate([
      'username' => 'required',
      'password' => 'required',
    ]);

    $remember_me = false;

    // kalo remember_me tidak null lakukan validasi
    if (!is_null($request->input('remember_me'))) {
      $request->validate([
        'remember_me' => 'accepted'
      ]);

      $remember_me = true;
    }

    $isLoginSuccess = Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']], $remember_me);

    if ($isLoginSuccess) {
      $request->session()->regenerate();

      // dd(Auth::user()->role);
      // dd($this->redirectTo());
      return redirect($this->redirectTo());
    }

    return redirect('/login')->withErrors([
      'username' => 'Username atau Password salah'
    ])->onlyInput('username');
  }

  protected function redirectTo()
  {
    // ini admin
    if (Auth::user()->role == 1) return '/dashboard';

    // ini customer
    return '/';
  }
}
