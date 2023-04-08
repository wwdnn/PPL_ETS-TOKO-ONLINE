<?php

namespace App\Controllers;

use App\Models\m_Barang;

class c_Barang extends BaseController
{
  public function index()
  {
    $model = new m_Barang();

    $data = [
      'barangs' => $model->getAllBarang()
    ];

    return view('v_Dashboard', $data);
  }

  public function store()
  {

    $validate = $this->validate([
      'namabrg' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Nama Barang harus diisi'
        ]
      ],
      'harga' => [
        'rules' => 'required|numeric',
        'errors' => [
          'required' => 'Harga Barang harus diisi',
          'numeric' => 'Harga Barang harus berupa angka'
        ]
      ],
      'stok' => [
        'rules' => 'required|numeric',
        'errors' => [
          'required' => 'Stok Barang harus diisi',
          'numeric' => 'Stok Barang harus berupa angka'
        ]
      ],
      'diskon' => [
        'rules' => 'required|numeric',
        'errors' => [
          'required' => 'Diskon Barang harus diisi',
          'numeric' => 'Diskon Barang harus berupa angka'
        ]
      ],
    ]);

    if (!$validate) {
      return view('v_AddBarang', [
        'validation' => $this->validator
      ]);
    }
    else {
      $image = $this->request->getFile('gambar');
      $fileName = uniqid() . '.' . $image->getClientExtension();
      $image->move(ROOTPATH . 'public/products', $fileName);

      $model = new m_Barang();

      $data = [
        'idkemeja' => $model->countAllResults() + 1,
        'namabrg' => $this->request->getPost('namabrg'),
        'harga' => $this->request->getPost('harga'),
        'stok' => $this->request->getPost('stok'),
        'diskon' => $this->request->getPost('diskon'),
        'namafile' => $fileName
      ];

      $model->insert($data);

      return redirect()->to(base_url('home'))->with('success', 'Barang berhasil ditambahkan');
    }

  }
}
