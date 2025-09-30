<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Ke mana pengguna diarahkan setelah login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Konstruktor controller.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Override metode ini agar login pakai username, bukan email.
     *
     * @return string
     */
    public function username()
    {
        return 'username'; // Ini kunci utama
    }

    /**
     * Validasi dan otentikasi berdasarkan username & password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only('username', 'password');
    }
}
