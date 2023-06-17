<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends BaseController
{
    public function index()
    {
        //
    }

    public function penjualan()
    {
        // $result = mysqli_query($conn, "SELECT * FROM produksi WHERE terima = 1 and tanggal between '$date1' and '$date2'");
        // translate to ci
        $db = \Config\Database::connect();
        $date1 = $this->request->getPost('date1');
        $date2 = $this->request->getPost('date2');
        // if data1 and date2 not set, set default value
        if (!$date1) {
            $date1 = date('Y-m-d', strtotime('-1 month'));
        }
        if (!$date2) {
            $date2 = date('Y-m-d');
        }
        $query = $db->query("SELECT * FROM produksi WHERE terima = 1 and tanggal between '$date1' and '$date2'");
        $data['result'] = $query->getResultArray();
        $data['date1'] = $date1;
        $data['date2'] = $date2;
        return view('admin/laporan/penjualan', $data);
    }

    public function exp_penjualan()
    {
        $db = \Config\Database::connect();
        $date1 = $this->request->getPost('date1');
        $date2 = $this->request->getPost('date2');
        // if data1 and date2 not set, set default value
        if (!$date1) {
            $date1 = date('Y-m-d', strtotime('-1 month'));
        }
        if (!$date2) {
            $date2 = date('Y-m-d');
        }
        $query = $db->query("SELECT * FROM produksi WHERE terima = 1 and tanggal between '$date1' and '$date2'");
        $data['result'] = $query->getResultArray();
        // dd($data);
        // write to excel using phpoffice
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID Order');
        $sheet->setCellValue('B1', 'Invoice');
        $sheet->setCellValue('C1', 'Kode Customer');
        $sheet->setCellValue('D1', 'Kode Produk');
        $sheet->setCellValue('E1', 'Nama Produk');
        $sheet->setCellValue('F1', 'Qty');
        $sheet->setCellValue('G1', 'Harga');
        $sheet->setCellValue('H1', 'Status');
        $sheet->setCellValue('I1', 'Tanggal');
        $sheet->setCellValue('J1', 'Provinsi');
        $sheet->setCellValue('K1', 'Kota');
        $sheet->setCellValue('L1', 'Alamat');
        $sheet->setCellValue('M1', 'Kode Pos');

        // set $i to lenght of data + 2
        $i = count($data['result']) + 1;
        foreach ($data['result'] as $row) {
            $sheet->setCellValue('A' . $i, $row['id_order']);
            $sheet->setCellValue('B' . $i, $row['invoice']);
            $sheet->setCellValue('C' . $i, $row['kode_customer']);
            $sheet->setCellValue('D' . $i, $row['kode_produk']);
            $sheet->setCellValue('E' . $i, $row['nama_produk']);
            $sheet->setCellValue('F' . $i, $row['qty']);
            $sheet->setCellValue('G' . $i, $row['harga']);
            $sheet->setCellValue('H' . $i, $row['status']);
            $sheet->setCellValue('I' . $i, $row['tanggal']);
            $sheet->setCellValue('J' . $i, $row['provinsi']);
            $sheet->setCellValue('K' . $i, $row['kota']);
            $sheet->setCellValue('L' . $i, $row['alamat']);
            $sheet->setCellValue('M' . $i, $row['kode_pos']);
            $i++;
        }

        
        $writer = new Xlsx($spreadsheet);
        // create filename to unique + laporan_penjualan
        $filename = uniqid() . '_laporan_penjualan.xlsx';
        // save to public/laporan
        $writer->save('laporan/' . $filename);
        // download
        return $this->response->download('laporan/' . $filename, null);
        

        
    }

    public function inventory(){
        $db = \Config\Database::connect();
        $date1 = $this->request->getPost('date1');
        $date2 = $this->request->getPost('date2');
        // if data1 and date2 not set, set default value
        if (!$date1) {
            $date1 = date('Y-m-d', strtotime('-1 month'));
        }
        if (!$date2) {
            $date2 = date('Y-m-d');
        }
        $query = $db->query("SELECT * FROM inventory WHERE  tanggal between '$date1' and '$date2'");
        $data['result'] = $query->getResultArray();
        $data['date1'] = $date1;
        $data['date2'] = $date2;
        return view('admin/laporan/inventory', $data);
    }

    public function exp_inventory()
    {
        $db = \Config\Database::connect();
        $date1 = $this->request->getPost('date1');
        $date2 = $this->request->getPost('date2');
        // if data1 and date2 not set, set default value
        if (!$date1) {
            $date1 = date('Y-m-d', strtotime('-1 month'));
        }
        if (!$date2) {
            $date2 = date('Y-m-d');
        }
        $query = $db->query("SELECT * FROM inventory WHERE  tanggal between '$date1' and '$date2'");
        $data['result'] = $query->getResultArray();
        // export to excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Set the headers
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nama Produk');
        $sheet->setCellValue('C1', 'Stok');
        $sheet->setCellValue('D1', 'Tanggal');
        
        // Populate the data rows
        $i = count($data['result']) + 1;
        foreach ($data['result'] as $row) {
            $sheet->setCellValue('A' . $i, $row['kode_bk']);
            $sheet->setCellValue('B' . $i, $row['nama']);
            $sheet->setCellValue('C' . $i, $row['qty']);
            $sheet->setCellValue('D' . $i, $row['tanggal']);
            $i++;
        }
        // Save the spreadsheet
        $writer = new Xlsx($spreadsheet);
        $filename = uniqid() . '_laporan_inventory.xlsx';
        $writer->save('laporan/' . $filename);
    
        // Download the file
        return $this->response->download('laporan/' . $filename, null);
        
    }

    public function profit()
    {
        $db = \Config\Database::connect();
        $date1 = $this->request->getPost('date1');
        $date2 = $this->request->getPost('date2');
        // if data1 and date2 not set, set default value
        if (!$date1) {
            $date1 = date('Y-m-d', strtotime('-1 month'));
        }
        if (!$date2) {
            $date2 = date('Y-m-d');
        }
        $query = $db->query("SELECT * FROM produksi WHERE terima = 1 and tanggal between '$date1' and '$date2'");
        $data['result'] = $query->getResultArray();
        $data['date1'] = $date1;
        $data['date2'] = $date2;
        return view('admin/laporan/profit', $data);
    }

    public function exp_profit()
    {
        $db = \Config\Database::connect();
    $date1 = $this->request->getPost('date1');
    $date2 = $this->request->getPost('date2');
    // if date1 and date2 not set, set default values
    if (!$date1) {
        $date1 = date('Y-m-d', strtotime('-1 month'));
    }
    if (!$date2) {
        $date2 = date('Y-m-d');
    }
    $query = $db->query("SELECT * FROM produksi WHERE terima = 1 and tanggal between '$date1' and '$date2'");
    $result = $query->getResultArray();

    // Create the spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set the headers
    $sheet->setCellValue('A1', 'ID Order');
    $sheet->setCellValue('B1', 'Invoice');
    $sheet->setCellValue('C1', 'Kode Customer');
    $sheet->setCellValue('D1', 'Kode Produk');
    $sheet->setCellValue('E1', 'Nama Produk');
    $sheet->setCellValue('F1', 'Qty');
    $sheet->setCellValue('G1', 'Harga');
    $sheet->setCellValue('H1', 'Status');
    $sheet->setCellValue('I1', 'Tanggal');
    $sheet->setCellValue('J1', 'Provinsi');
    $sheet->setCellValue('K1', 'Kota');
    $sheet->setCellValue('L1', 'Alamat');
    $sheet->setCellValue('M1', 'Kode Pos');

    // Populate the data rows
    $i = 2;
    foreach ($result as $row) {
        $sheet->setCellValue('A' . $i, $row['id_order']);
        $sheet->setCellValue('B' . $i, $row['invoice']);
        $sheet->setCellValue('C' . $i, $row['kode_customer']);
        $sheet->setCellValue('D' . $i, $row['kode_produk']);
        $sheet->setCellValue('E' . $i, $row['nama_produk']);
        $sheet->setCellValue('F' . $i, $row['qty']);
        $sheet->setCellValue('G' . $i, $row['harga']);
        $sheet->setCellValue('H' . $i, $row['status']);
        $sheet->setCellValue('I' . $i, $row['tanggal']);
        $sheet->setCellValue('J' . $i, $row['provinsi']);
        $sheet->setCellValue('K' . $i, $row['kota']);
        $sheet->setCellValue('L' . $i, $row['alamat']);
        $sheet->setCellValue('M' . $i, $row['kode_pos']);
        $i++;
    }

    $writer = new Xlsx($spreadsheet);
    // Create a unique filename for the report
    $filename = uniqid() . '_laporan_profit.xlsx';
    // Save the file in the 'laporan' directory
    $writer->save('laporan/' . $filename);

    // Download the file
    return $this->response->download('laporan/' . $filename, null);
    }

    public function omset()
    {
        $db = \Config\Database::connect();
        $date1 = $this->request->getPost('date1');
        $date2 = $this->request->getPost('date2');
        // if data1 and date2 not set, set default value
        if (!$date1) {
            $date1 = date('Y-m-d', strtotime('-1 month'));
        }
        if (!$date2) {
            $date2 = date('Y-m-d');
        }
        $query = $db->query("SELECT * FROM produksi WHERE terima = 1 and tanggal between '$date1' and '$date2'");
        $data['result'] = $query->getResultArray();
        $data['date1'] = $date1;
        $data['date2'] = $date2;
        return view('admin/laporan/omset', $data);
    }

    public function exp_omset()
    {
        $db = \Config\Database::connect();
    $date1 = $this->request->getPost('date1');
    $date2 = $this->request->getPost('date2');
    
    // Set default values if date1 and date2 are not set
    if (!$date1) {
        $date1 = date('Y-m-d', strtotime('-1 month'));
    }
    if (!$date2) {
        $date2 = date('Y-m-d');
    }
    
    $query = $db->query("SELECT * FROM produksi WHERE terima = 1 AND tanggal BETWEEN '$date1' AND '$date2'");
    $data['result'] = $query->getResultArray();
    
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    
    $sheet->setCellValue('A1', 'ID Order');
    $sheet->setCellValue('B1', 'Invoice');
    $sheet->setCellValue('C1', 'Kode Customer');
    $sheet->setCellValue('D1', 'Kode Produk');
    $sheet->setCellValue('E1', 'Nama Produk');
    $sheet->setCellValue('F1', 'Qty');
    $sheet->setCellValue('G1', 'Harga');
    $sheet->setCellValue('H1', 'Status');
    $sheet->setCellValue('I1', 'Tanggal');
    $sheet->setCellValue('J1', 'Provinsi');
    $sheet->setCellValue('K1', 'Kota');
    $sheet->setCellValue('L1', 'Alamat');
    $sheet->setCellValue('M1', 'Kode Pos');
    
    $i = 2;
    foreach ($data['result'] as $row) {
        $sheet->setCellValue('A' . $i, $row['id_order']);
        $sheet->setCellValue('B' . $i, $row['invoice']);
        $sheet->setCellValue('C' . $i, $row['kode_customer']);
        $sheet->setCellValue('D' . $i, $row['kode_produk']);
        $sheet->setCellValue('E' . $i, $row['nama_produk']);
        $sheet->setCellValue('F' . $i, $row['qty']);
        $sheet->setCellValue('G' . $i, $row['harga']);
        $sheet->setCellValue('H' . $i, $row['status']);
        $sheet->setCellValue('I' . $i, $row['tanggal']);
        $sheet->setCellValue('J' . $i, $row['provinsi']);
        $sheet->setCellValue('K' . $i, $row['kota']);
        $sheet->setCellValue('L' . $i, $row['alamat']);
        $sheet->setCellValue('M' . $i, $row['kode_pos']);
        $i++;
    }
    // Save the spreadsheet
    $writer = new Xlsx($spreadsheet);
    $filename = uniqid() . '_laporan_omset.xlsx';
    $writer->save('laporan/' . $filename);
    
    // Download the file
    return $this->response->download('laporan/' . $filename, null);
    }

    public function pembatalan()
    {
        // $result = mysqli_query($conn, "SELECT * FROM produksi WHERE tolak = 1 and tanggal between '$date1' and '$date2'");
        $db = \Config\Database::connect();
        $date1 = $this->request->getPost('date1');
        $date2 = $this->request->getPost('date2');
        // if data1 and date2 not set, set default value
        if (!$date1) {
            $date1 = date('Y-m-d', strtotime('-1 month'));
        }
        if (!$date2) {
            $date2 = date('Y-m-d');
        }

        $query = $db->query("SELECT * FROM produksi WHERE tolak = 1 and tanggal between '$date1' and '$date2'");
        $data['result'] = $query->getResultArray();
        $data['date1'] = $date1;
        $data['date2'] = $date2;
        return view('admin/laporan/pembatalan', $data);
        
    }

    public function exp_pembatalan()
    {
        $db = \Config\Database::connect();
    $date1 = $this->request->getPost('date1');
    $date2 = $this->request->getPost('date2');
    
    // Set default values if date1 and date2 are not set
    if (!$date1) {
        $date1 = date('Y-m-d', strtotime('-1 month'));
    }
    if (!$date2) {
        $date2 = date('Y-m-d');
    }
    
    $query = $db->query("SELECT * FROM produksi WHERE terima = 0 AND tanggal BETWEEN '$date1' AND '$date2'");
    $data['result'] = $query->getResultArray();
    
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    
    $sheet->setCellValue('A1', 'ID Order');
    $sheet->setCellValue('B1', 'Invoice');
    $sheet->setCellValue('C1', 'Kode Customer');
    $sheet->setCellValue('D1', 'Kode Produk');
    $sheet->setCellValue('E1', 'Nama Produk');
    $sheet->setCellValue('F1', 'Qty');
    $sheet->setCellValue('G1', 'Harga');
    $sheet->setCellValue('H1', 'Status');
    $sheet->setCellValue('I1', 'Tanggal');
    $sheet->setCellValue('J1', 'Provinsi');
    $sheet->setCellValue('K1', 'Kota');
    $sheet->setCellValue('L1', 'Alamat');
    $sheet->setCellValue('M1', 'Kode Pos');
    
    $i = 2;
    foreach ($data['result'] as $row) {
        $sheet->setCellValue('A' . $i, $row['id_order']);
        $sheet->setCellValue('B' . $i, $row['invoice']);
        $sheet->setCellValue('C' . $i, $row['kode_customer']);
        $sheet->setCellValue('D' . $i, $row['kode_produk']);
        $sheet->setCellValue('E' . $i, $row['nama_produk']);
        $sheet->setCellValue('F' . $i, $row['qty']);
        $sheet->setCellValue('G' . $i, $row['harga']);
        $sheet->setCellValue('H' . $i, $row['status']);
        $sheet->setCellValue('I' . $i, $row['tanggal']);
        $sheet->setCellValue('J' . $i, $row['provinsi']);
        $sheet->setCellValue('K' . $i, $row['kota']);
        $sheet->setCellValue('L' . $i, $row['alamat']);
        $sheet->setCellValue('M' . $i, $row['kode_pos']);
        $i++;
    }
    // Save the spreadsheet
    $writer = new Xlsx($spreadsheet);
    $filename = uniqid() . '_laporan_pembatalan.xlsx';
    $writer->save('laporan/' . $filename);
    
    // Download the file
    return $this->response->download('laporan/' . $filename, null);
    }

    public function produksi()
    {
        $db = \Config\Database::connect();
        $date1 = $this->request->getPost('date1');
        $date2 = $this->request->getPost('date2');

        // if data1 and date2 not set, set default value
        if (!$date1) {
            $date1 = date('Y-m-d', strtotime('-1 month'));
        }
        if (!$date2) {
            $date2 = date('Y-m-d');
        }

        $query = $db->query("SELECT * FROM produksi WHERE terima = 1 and tanggal between '$date1' and '$date2'");
        $data['result'] = $query->getResultArray();
        $data['date1'] = $date1;
        $data['date2'] = $date2;
        return view('admin/laporan/produksi', $data);
    }

    public function exp_produksi()
    {
        $db = \Config\Database::connect();
    $date1 = $this->request->getPost('date1');
    $date2 = $this->request->getPost('date2');
    
    // Set default values if date1 and date2 are not set
    if (!$date1) {
        $date1 = date('Y-m-d', strtotime('-1 month'));
    }
    if (!$date2) {
        $date2 = date('Y-m-d');
    }
    
    $query = $db->query("SELECT * FROM produksi WHERE tanggal BETWEEN '$date1' AND '$date2'");
    $data['result'] = $query->getResultArray();
    
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    
    $sheet->setCellValue('A1', 'ID Produksi');
    $sheet->setCellValue('B1', 'Tanggal');
    $sheet->setCellValue('C1', 'Jumlah Produksi');
    $sheet->setCellValue('D1', 'Keterangan');
    
    $i = 2;
    foreach ($data['result'] as $row) {
        $sheet->setCellValue('A' . $i, $row['id_produksi']);
        $sheet->setCellValue('B' . $i, $row['tanggal']);
        $sheet->setCellValue('C' . $i, $row['jumlah_produksi']);
        $sheet->setCellValue('D' . $i, $row['keterangan']);
        $i++;
    }
    // Save the spreadsheet
    $writer = new Xlsx($spreadsheet);
    $filename = uniqid() . '_laporan_produksi.xlsx';
    $writer->save('laporan/' . $filename);
    
    // Download the file
    return $this->response->download('laporan/' . $filename, null);
    }
}
