<?php

namespace App\Services;

use App\Models\User;

class LoginService
{
     public function login($request)
     {
          // dd($request->email);
          $user = User::where('email', $request->email)->first();
          $password = password_verify($request->password, $user->password);
          // dd($password);

          if (!$user || !$password) {
               return null;
          }
          return $user;
     }
}