<?php

namespace App\Controllers;

use App\Models\UserModel;
// use CodeIgniter\Controller;
use App\Controllers\BaseController;
// use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function __construct()
    {
        helper(['form', 'url', 'session']);
    }

    /* 
    Menampilkan form login
     */

    public function login()
    {
        // Jika user sudah login, redirect ke dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        $data = [
            'title' => 'Login Page | My Blog',
            'validation' => \Config\Services::validation(),
        ];

        return view('auth/login', $data);
        
    }

    /* Proses autentikasi login */

    public function attemptLogin()
    {
        // Validasi input
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        // Cek apakah user ditemukan
        if ($user) {
            session()->setFlashdata('error', 'Email atau password salah.');
            return redirect()->back()->withInput();
        }

        // Set session data

        $sessionData = [
            'user_id'    => $user['id'],
            'username'  => $user['username'],
            'email'     => $user['email'],
            'role'     => $user['role'],
            'isLoggedIn' => true,
        ];

        session()->set($sessionData);

        // Redirect berdasarkan role
        if ($user['role'] === 'admin') {
            return redirect()->to('/admin/dashboard');
        } else {
            return redirect()->to('/');
        }
    }

        /* 
        Proses logout
         */

    public function logout()
    {
        // Hapus semua session data
        session()->destroy();

        // Redirect ke halaman login
        return redirect()->to('/login');
    }
        
}