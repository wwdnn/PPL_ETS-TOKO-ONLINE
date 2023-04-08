<?php

namespace App\Models;
use CodeIgniter\Model;

class m_Admin extends Model
{
  public function __construct()
  {
    $this->db = \Config\Database::connect();
  }

  public function cekLogin($nip, $username, $password)
  {
    
    $query = "SELECT * FROM pegawai WHERE NIP = '$nip' AND username = '$username'";
    $data = $this->db->query($query)->getRowArray();

    if($data)
    {
      $hash = $data['password'];
      if(password_verify($password, $hash))
      {
        return $data;
      } 
    }
    return null;

  }
}