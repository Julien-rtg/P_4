<?php

namespace Models\core;

use App\Database;

class MainModel
{

    protected $db;
    protected $conn;

    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->getPDO();
    }
}
