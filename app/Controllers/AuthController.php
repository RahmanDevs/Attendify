<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use CodeIgniter\Cache\Handlers\RedisHandler;
use PhpParser\Node\Stmt\Expression;

class AuthController extends BaseController
{   
    // TAMPILAN FORM LOGIN
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        return view('login');
    }

    // PROSES LOGIN 
    public function processLogin() 
    {
        $session = session(); 
        $model = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if($user){
            if(password_verify($password, $user['password'])){
                $sessionData = [
                    'user_id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'isLoggedIn' => true
                ];

                // Session data
                $session->set($sessionData);
                return redirect()->to('/');
            } else {
                return redirect()->back()->withInput()->with('error', 'Password salah!');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Email tidak terdaftar!');
        }
    }

    // TAMPILAN FORM REGISTER
    public function register()
    {
        if(session()->get('isLoggedIn')){
            return redirect()->to('/');
        }
        return view('/login');
    }

    // PROSES REGISTER
    public function processRegister()
    {   
        // Make a rules
        $rules = [
            'name' => 'required|min_length[3]|max_length[50]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]'
        ];

        // Validation the rules (checking)
        if(!$this->validate($rules)){
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new UserModel();
        $model->save([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password')
        ]);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silahkan login!');
    }

    # PROSES LOGOUT
    public function logout()
    {
        session()->destroy(); 
        return redirect()->to('login')->with('success', 'Anda telah berhasil keluar');
    }
}
