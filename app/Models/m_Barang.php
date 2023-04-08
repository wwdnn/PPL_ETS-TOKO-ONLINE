<?php

  // Models
  namespace App\Models;
  use CodeIgniter\Model;
  
  class m_Barang extends Model
  { 
    protected $table = 'kemeja';
    protected $primaryKey = 'idkemeja';
    protected $allowedFields = ['idkemeja', 'namabrg', 'harga', 'diskon', 'stok', 'namafile'];

    public function __construct()
    { 
      // connect db
      $this->db = \Config\Database::connect();
    }

    public function getAllBarang()
    {
      $sql = "SELECT * FROM kemeja";
      $query = $this->db->query($sql);
      return $query->getResultArray();
    }

    public function getBarang($kode_barang)
    {
      $sql = "SELECT * FROM kemeja WHERE idkemeja = ?";
      $query = $this->db->query($sql, [$kode_barang]);
      return $query->getRowArray();
    }

    public function getStok($kode_barang)
    {
      $sql = "SELECT stok FROM kemeja WHERE idkemeja = ?";
      $query = $this->db->query($sql, [$kode_barang]);
      return $query->getRowArray();
    }

    public function tambahBarang($data)
    {
      $sql = "INSERT INTO kemeja (namabrg, harga, diskon, stok, namafile) VALUES (?, ?, ?, ?, ?)";
      $query = $this->db->query($sql, $data);
      return $this->db->affectedRows();
    }
  }