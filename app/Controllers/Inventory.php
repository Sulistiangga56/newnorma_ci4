<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InventoryModel;

class Inventory extends BaseController
{
    public function index()
    {
        $inventory = new InventoryModel();
        $result = $inventory->findAll();
        $data = [
            'title' => 'Inventory',
            'result' => $result,
        ];
        return view('admin/inventory', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Inventory',
        ];
        return view('admin/tambahinventory', $data);
    }

    public function simpan()
    {
        $inventory = new InventoryModel();
        $data = [
            'kode_bk' => $this->request->getPost('kode_bk'),
            'nama' => $this->request->getPost('nama'),
            'qty' => $this->request->getPost('qty'),
            'satuan' => $this->request->getPost('satuan'),
            'harga' => $this->request->getPost('harga'),
        ];
        $data['tanggal'] = date('Y-m-d');
        $inventory->insert($data);
        return redirect()->to(base_url('admin/inventory'))->with('success', 'inventory berhasil ditambahkan');
    }

    public function edit($id)
    {
        $inventory = new InventoryModel();
        $result = $inventory->find($id);
        $data = [
            'title' => 'Edit Inventory',
            'result' => $result,
        ];
        return view('admin/editinventory', $data);
    }

    public function update($id)
    {
        $inventory = new InventoryModel();
        $data = [
            'kode_bk' => $this->request->getPost('kode_bk'),
            'nama' => $this->request->getPost('nama'),
            'qty' => $this->request->getPost('qty'),
            'satuan' => $this->request->getPost('satuan'),
            'harga' => $this->request->getPost('harga'),
            'tanggal' => $this->request->getPost('tanggal'),
        ];
        $inventory->update($id, $data);
        return redirect()->to(base_url('admin/inventory'))->with('success', 'inventory berhasil diupdate');
    }

    public function hapus($id)
    {
        $inventory = new InventoryModel();
        $inventory->delete($id);
        return redirect()->to(base_url('admin/inventory'))->with('success', 'inventory berhasil dihapus');
    }
}
