<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB, Hash};
use App\Http\Requests\User\StoreRequest as UserStoreRequest;
use App\Http\Requests\Penyewaan\StoreRequest as PenyewaanStoreRequest;
use App\Models\{User, Lapangan, Notification, Penyewaan};

class CustomerController extends Controller
{
  public function login()
  {
    return view('user.login');
  }

  public function register()
  {
    return view('user.register');
  }

  public function postRegister(UserStoreRequest $request)
  {
    $formFields = $request->validated();

    // delete unnecessary field from being inserted to database
    unset($formFields['password_confirmation']);

    $formFields['password'] = Hash::make($formFields['password']);

    $formFields['role'] = 2;

    $user = User::create($formFields);

    Auth::login($user);

    return redirect('/');
  }

  public function postLogin(Request $request)
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

    $isLoginSuccess = Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password'], 'role' => 2], $remember_me);

    if ($isLoginSuccess) {
      $request->session()->regenerate();

      return redirect('/');
    }

    return redirect('/login')->withErrors([
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
