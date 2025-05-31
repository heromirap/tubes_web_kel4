<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
  /**
   * Get the path the user should be redirected to when they are not authenticated.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return string|null
   */
  protected function redirectTo($request)
  {
    if (!$request->expectsJson()) {
      // return route('home');
      // $route = collect(explode('/', $request->getUri()))->last();

      return route('login');
      // switch ($route) {
      //   case 'booking':
      //     return route('login');
      //     break;
      //   default:
      //     return route('home');
      // }
    }
  }
}
