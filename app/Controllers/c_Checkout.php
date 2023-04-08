<?php

namespace App\Controllers;

class c_Checkout extends BaseController
{
  public function index()
  {
    $carts = \Config\Services::cart();
    $data = [
      'carts' => $carts->contents()
    ];

    return view('v_Checkout', $data);
  }

  public function process()
  {
    $carts = \Config\Services::cart();
    $transaksi = new \App\Models\m_TransaksiPjl();

    // get data from form
    $data = [
      'idtrans' => $transaksi->countAllResults() + 1,
      'nama' => $this->request->getPost('nama_pembeli'),
      'hp' => $this->request->getPost('nomor_pembeli'),
      'alamat' => $this->request->getPost('alamat_pembeli'),
      'kecamatan' => $this->request->getPost('kecamatan_pembeli'),
      'kota' => $this->request->getPost('kota_pembeli'),
      'total' => $carts->total(),

    ];

    $validate = $this->validate([
      'nama_pembeli' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Nama pembeli harus diisi'
        ]
      ],
      'nomor_pembeli' => [
        'rules' => 'required|numeric|min_length[10]|max_length[13]',
        'errors' => [
          'required' => 'Nomor pembeli harus diisi',
          'numeric' => 'Nomor pembeli harus berupa angka dengan diawali 08',
          'min_length' => 'Nomor pembeli harus berupa angka dengan diawali 08',
          'max_length' => 'Nomor pembeli harus berupa angka dengan diawali 08'
        ]
      ],
      'alamat_pembeli' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Alamat pembeli harus diisi'
        ]
      ],
      'kecamatan_pembeli' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Kecamatan pembeli harus diisi'
        ]
      ],
      'kota_pembeli' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Kota pembeli harus diisi'
        ]
      ],

    ]);

  
    // if nomor pembeli tidak diawali 08
    if (substr($data['hp'], 0, 2) != '08') {
      return view('v_Checkout', [
        'validation' => $this->validator,
        'carts' => $carts->contents()
      ]);
    }

    // validate data
    if (!$validate) {
      return view('v_Checkout', [
        'validation' => $this->validator,
        'carts' => $carts->contents()
      ]);
    }

    // insert data to database
    $transaksi->insert($data);

    // insert detail transaksi
    $detail_transaksi = new \App\Models\m_DetailJual();
    $barang = new \App\Models\m_Barang();


    foreach ($carts->contents() as $item) {
      $detail_transaksi->insert([
        'idtrans' => $data['idtrans'],
        'idkemeja' => $item['id'],
        'hargajual' => $item['price'],
        'jmljual' => $item['qty']
      ]);

      // get stok barang
      $stok_barang = $barang->getStok($item['id']);
      // parse to int
      $stok_barang = (int) $stok_barang['stok'];

      // update stok barang
      $barang->update($item['id'], [
        'stok' => $stok_barang - $item['qty']
      ]);
    }

    // destroy cart
    $carts->destroy();

    // return with message
    return redirect()->to(base_url('/dashboard'))->with('success', 'Transaksi berhasil');
  }
}
