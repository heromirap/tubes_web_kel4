<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use Illuminate\Support\Facades\{Hash, Auth};

class RegisterController extends Controller
{
  public function index() {
    return view('auth.register');
  }

  public function create(StoreRequest $request) {
    $formFields = $request->validated();

    // delete unnecessary field from being inserted to database
    unset($formFields['password_confirmation']);

    $formFields['password'] = Hash::make($formFields['password']);

    $user = User::create($formFields);

    Auth::login($user);

    return $formFields['role'] == 1 ? redirect('/dashboard') :  redirect('/');
  }
}
