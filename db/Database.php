<?php

namespace App;

use App\Config;

class Database extends Config {
    
    public $pdo;
    private $credits;

    public function __construct()
    {
        $this->credits = $this->getCredits();
    }

    private function connect(){
        try {
            $dbh = new \PDO('mysql:host='.$this->credits['host'].';dbname='.$this->credits['db_name'], $this->credits['user'], $this->credits['pass']);
            return $dbh;
        } catch (\PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function getPDO(){
        $this->pdo = $this->connect();
        return $this->pdo;
    }

}