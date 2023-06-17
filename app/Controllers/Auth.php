<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomerModel;
use App\Models\AdminModel;

class Auth extends BaseController
{

    protected $helpers = ['form'];

    public function register()
    {
        return view('register');
    }

    public function doRegister()
    {
        $customer = new CustomerModel();
        // get kode_customer order by kode_customer desc
        $lastCustomer = $customer->orderBy('kode_customer', 'DESC')->first();
        // if kode_customer is null, set kode_customer = C0000
        if ($lastCustomer == null) {
            $lastCustomer['kode_customer'] = "C0000";
        }
        $lastKodeCustomer = substr($lastCustomer['kode_customer'], 1, 4);
        $add = (int) $lastKodeCustomer + 1;
        if (strlen($add) == 1) {
            $format = "C000" . $add;
        } else if (strlen($add) == 2) {
            $format = "C00" . $add;
        } else if (strlen($add) == 3) {
            $format = "C0" . $add;
        } else {
            $format = "C" . $add;
        }
        
        $data = [
            'kode_customer' => $format ,
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'konfirmasi' => $this->request->getPost('konfirmasi'), 
            'telp' => $this->request->getPost('telp'),
        ];

        $rules = [
                'nama' => 'required',
                'email' => 'required|valid_email|is_unique[customer.email]',
                'username' => 'required|is_unique[customer.username]',
                'password' => 'required|min_length[8]',
                'konfirmasi' => 'matches[password]',
                'telp' => 'required|numeric|min_length[10]|max_length[13]',
            
        ];

        $pesan_error = [
            'nama' => [
                'required' => 'Nama harus diisi'
            ],
            'email' => [
                'required' => 'Email harus diisi',
                'valid_email' => 'Email tidak valid',
                'is_unique' => 'Email sudah terdaftar'
            ],
            'username' => [
                'required' => 'Username harus diisi',
                'is_unique' => 'Username sudah terdaftar, gunakan username lain'
            ],
            'password' => [
                'required' => 'Password harus diisi',
                'min_length' => 'Password minimal 8 karakter'
            ],
            'konfirmasi' => [
                'matches' => 'Konfirmasi password tidak sesuai'
            ],
            'telp' => [
                'required' => 'No. Telp harus diisi',
                'numeric' => 'No. Telp harus berupa angka',
                'min_length' => 'No. Telp minimal 10 karakter',
                'max_length' => 'No. Telp maksimal 13 karakter'
            ],
        ];
        $validation =  \Config\Services::validation();
        // set my custom view error layout
        $validation->listErrors('errors_list');
        $validation->setRules($rules, $pesan_error);
        if (!$validation->run($data)) {
            return redirect()->back()->withInput();
        }

        // hash password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        // delete konfirmasi password
        unset($data['konfirmasi']);
        $customer->insert($data);
        return redirect()->to('/login');
    }

    public function login()
    {
        return view('login');
    }

    public function doLoginCustomer()
    {
        $customer = new CustomerModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $data = $customer->where('username', $username)->first();
        if ($data) {
            if (password_verify($password, $data['password'])) {
                $data_session = [
                    'kode_customer' => $data['kode_customer'],
                    'nama' => $data['nama'],
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'telp' => $data['telp'],
                    'logged_in' => TRUE
                ];
                session()->set($data_session);
                return redirect()->to(base_url());
            } else {
                session()->setFlashdata('pesan', 'Password salah');
                return redirect()->to(base_url('login'));
            }
        } else {
            session()->setFlashdata('pesan', 'Username tidak ditemukan');
            return redirect()->to(base_url('login'));
        }
    }

    public function doLoginAdmin(){
        $admin = new AdminModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $data = $admin->where('username', $username)->first();
        if ($data) {
            if (password_verify($password, $data['password'])) {
                $data_session = [                    
                    'username' => $data['username'],
                    'is_admin' => TRUE,
                    'logged_in' => TRUE
                ];
                session()->set($data_session);
                return redirect()->to(base_url('admin'));
            } else {
                session()->setFlashdata('pesan', 'Password salah');
                return redirect()->to(base_url('login/admin'));
            }
        } else {
            session()->setFlashdata('pesan', 'Username tidak ditemukan');
            return redirect()->to(base_url('login'));
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
