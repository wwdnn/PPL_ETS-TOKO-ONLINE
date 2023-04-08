<?php

namespace App\Controllers;

class c_Pegawai extends BaseController 
{
  public function index()
  {

    $barang = new \App\Models\m_Barang();
    $data = [
      'barang' => $barang->getAllBarang()
    ];
    return view('v_Pegawai', $data);
  }

  public function createBarang()
  {
    return view('v_AddBarang');
  }
}