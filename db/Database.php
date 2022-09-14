<?php

namespace App;


class Database extends Config {
    
    public $pdo;
    private $credits;

    public function __construct()
    {
        $this->credits = $this->getCredits();
    }

    private function connect(): ?object
    {
        try {
            $dbh = new \PDO('mysql:host='.$this->credits['host'].';dbname='.$this->credits['db_name'], $this->credits['user'], $this->credits['pass']);
            return $dbh;
        } catch (\PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }

    public function getPDO(): ?object
    {
        $this->pdo = $this->connect();
        return $this->pdo;
    }

    public function query(string $statement): ?array
    {
        $pdo = $this->getPDO();
        $req = $pdo->prepare($statement);
        $req->execute();
        return $req->fetchAll();
    }

    public function insert(string $statement): ?array
    {
        $pdo = $this->getPDO();
        $req = $pdo->prepare($statement);
        return $req->execute();
    }
}
