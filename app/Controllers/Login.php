<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
    public function index()
    {
        if (session()->get('isLoggedIn')) {
            $role = session()->get('role') ?? 'employee';
            return redirect()->to($role === 'admin' ? '/admin/dashboard' : '/employee/dashboard');
        }
        return view('login');
    }
}
