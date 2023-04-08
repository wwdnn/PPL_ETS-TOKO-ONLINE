<?php

namespace App\Models;
use CodeIgniter\Model;

class m_DetailJual extends Model
{
  protected $table = 'detailjual';
  protected $primaryKey = 'idtrans';
  protected $allowedFields = ['idtrans', 'idkemeja', 'hargajual', 'jmljual'];
}