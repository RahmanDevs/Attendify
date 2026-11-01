<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class AuthController extends BaseController
{
    // TAMPILAN FORM LOGIN
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            $role = session()->get('role') ?? 'employee';
            return redirect()->to($role === 'admin' ? '/admin/dashboard' : '/employee/dashboard');
        }
        return view('login');
    }

    // PROSES LOGIN
    public function processLogin()
    {
        $session = session();
        $model = new UserModel();

        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user) {
            // Cek status aktif
            if (isset($user['is_active']) && (int)$user['is_active'] === 0) {
                return redirect()->back()->withInput()->with('error', 'Akun Anda dinonaktifkan. Silakan hubungi Administrator!');
            }

            if (password_verify($password, $user['password'])) {
                $role = $user['role'] ?? 'employee';

                $sessionData = [
                    'user_id'       => $user['id'],
                    'name'          => $user['name'],
                    'email'         => $user['email'],
                    'role'          => $role,
                    'department_id' => $user['department_id'] ?? null,
                    'shift_id'      => $user['shift_id'] ?? null,
                    'isLoggedIn'    => true
                ];

                $session->set($sessionData);

                if ($role === 'admin') {
                    return redirect()->to('/admin/dashboard')->with('success', 'Selamat datang kembali, ' . esc($user['name']) . '!');
                }
                return redirect()->to('/employee/dashboard')->with('success', 'Selamat datang kembali, ' . esc($user['name']) . '!');
            } else {
                return redirect()->back()->withInput()->with('error', 'Kata sandi tidak sesuai!');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Email tidak terdaftar!');
        }
    }

    // TAMPILAN FORM REGISTER
    public function register()
    {
        if (session()->get('isLoggedIn')) {
            $role = session()->get('role') ?? 'employee';
            return redirect()->to($role === 'admin' ? '/admin/dashboard' : '/employee/dashboard');
        }
        return view('login');
    }

    // PROSES REGISTER
    public function processRegister()
    {
        $rules = [
            'name'     => 'permit_empty|min_length[3]|max_length[100]',
            'fullname' => 'permit_empty|min_length[3]|max_length[100]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $name = $this->request->getPost('name') ?: $this->request->getPost('fullname');
        if (empty($name)) {
            return redirect()->back()->withInput()->with('error', 'Nama lengkap wajib diisi!');
        }

        $model = new UserModel();
        $model->save([
            'name'      => $name,
            'email'     => $this->request->getPost('email'),
            'password'  => $this->request->getPost('password'),
            'role'      => 'employee',
            'is_active' => 1
        ]);

        return redirect()->to('/login?mode=login')->with('success', 'Registrasi berhasil! Silakan login dengan akun Anda.');
    }

    // PROSES LOGOUT
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda telah berhasil keluar.');
    }
}
