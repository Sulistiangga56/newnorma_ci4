<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Admin extends BaseController
{
    public function index()
    {
        //         $result1 = mysqli_query($conn, "SELECT distinct invoice FROM produksi WHERE terima = 0 and tolak = 0");
        // $jml1 = mysqli_num_rows($result1);

        // // pesanan dibatalkan/ditolak
        // $result2 = mysqli_query($conn, "SELECT distinct invoice FROM produksi WHERE  tolak = 1");
        // $jml2 = mysqli_num_rows($result2);

        // // pesanan diterima
        // $result3 = mysqli_query($conn, "SELECT distinct invoice FROM produksi WHERE  terima = 1");
        // $jml3 = mysqli_num_rows($result3);

        // translate query above to ci
        $db = \Config\Database::connect();
        $query = $db->query("SELECT distinct invoice FROM produksi WHERE terima = 0 and tolak = 0");
        $jml1 = $query->getNumRows();

        $query = $db->query("SELECT distinct invoice FROM produksi WHERE  tolak = 1");
        $jml2 = $query->getNumRows();

        $query = $db->query("SELECT distinct invoice FROM produksi WHERE  terima = 1");
        $jml3 = $query->getNumRows();
        $data['pesanan_baru'] = $jml1;
        $data['pesanan_ditolak'] = $jml2;
        $data['pesanan_diterima'] = $jml3;
        return view('admin/index', $data);
    }

    public function login(){
        return view('admin/login');
    }

    public function doLogin(){
        $username = $this->request->getPost('user');
        $password = $this->request->getPost('pass');
        $admin = new \App\Models\AdminModel();
        $admin = $admin->where('username', $username)->first();
        if($admin){
            if(password_verify($password, $admin['password'])){
                session()->set(['username' => $admin['username'], 'is_admin' => TRUE, 'logged_in' => TRUE]);
                return redirect()->to(base_url('admin'));
            }else{
                session()->setFlashdata('error', 'Password salah');
                return redirect()->to(base_url('admin/login'));
            }
        }else{
            session()->setFlashdata('error', 'Username tidak ditemukan');
            return redirect()->to(base_url('admin/login'));
        }
    }

    public function logout(){
        session()->destroy();
        return redirect()->to(base_url('admin/login'));
    }
}
