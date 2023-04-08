<?php

namespace App\Controllers;
use App\Models\m_Admin as m_Admin;

class c_Autentikasi extends BaseController
{
  public function index()
  {
    return view('v_Login');
  }

  public function login()
  {
    $nip = $this->request->getPost('nip');
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    // dd($nip, $username, $password);

    $model = new m_Admin;
    $cek = $model->cekLogin($nip, $username, $password);

    if ($cek) {
      session()->set('username', $cek['username']);
      session()->set('login', TRUE);

      return redirect()->to(base_url('home'));
    } else {
      session()->setFlashdata('error', 'Username atau Password salah');
      return redirect()->to(base_url('/'));
    }
  }

  public function logout()
  {
    session()->destroy();
    return redirect()->to(base_url('/'));
  }
}
