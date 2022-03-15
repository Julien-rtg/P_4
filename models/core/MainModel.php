<?php

namespace Models\core;

use App\Database;

class MainModel
{

    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}
