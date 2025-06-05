<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\User\StoreRequest;
use Illuminate\Support\Facades\{Auth, Hash};

class AdminController extends Controller
{
  public function index()
  {
    return view('auth.login');
  }

  public function create()
  {
    return view('auth.register');
  }

  public function store(StoreRequest $request)
  {
    $formFields = $request->validated();

    // delete unnecessary field from being inserted to database
    unset($formFields['password_confirmation']);

    $formFields['password'] = Hash::make($formFields['password']);

    $formFields['role'] = 1;

    $user = User::create($formFields);

    Auth::login($user);

    return redirect(RouteServiceProvider::HOME);
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

    $isLoginSuccess = Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password'], 'role' => 1], $remember_me);

    if ($isLoginSuccess) {
      $request->session()->regenerate();

      return redirect(RouteServiceProvider::HOME);
    }

    return redirect('/login-admin')->withErrors([
      'username' => 'Username atau Password salah'
    ])->onlyInput('username');
  }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
  }
}