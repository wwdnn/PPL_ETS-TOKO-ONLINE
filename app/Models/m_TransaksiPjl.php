<?php

namespace App\Models;

use CodeIgniter\Model;

class m_TransaksiPjl extends Model
{
  protected $table = 'transaksipjl';
  protected $primaryKey = 'idtrans';
  protected $allowedFields = ['idtrans','nama', 'hp', 'alamat', 'kecamatan', 'kota', 'total'];

  public function __construct()
  {
    // connect db
    $this->db = \Config\Database::connect();
  }
}
