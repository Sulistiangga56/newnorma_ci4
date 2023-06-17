<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomerModel;

class Customer extends BaseController
{
    public function index()
    {
        $customer = new CustomerModel();
        $result = $customer->findAll();
        $data = [
            'title' => 'Customer',
            'result' => $result,
        ];
        return view('admin/customer', $data);
    }

    public function hapus($id){
        $customer = new CustomerModel();
        $customer->delete($id);
        return redirect()->to(base_url('admin/customer'))->with('success', 'customer berhasil dihapus');
    }
}
