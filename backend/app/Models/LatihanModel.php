<?php

namespace App\Models;

use CodeIgniter\Model;

class LatihanModel extends Model
{
    protected $table = 'latihan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['judul', 'deskripsi', 'tanggal_publikasi', 'link_video'];
}