<?php

namespace Models;

use Models\core\MainModel;
use PDO;



class AccountsModel extends MainModel
{

    private $returnDatas = [];

    public function login(string $email): ?array
    {
        $stmt = $this->conn->prepare('SELECT id, mdp FROM utilisateur WHERE email = :email');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        if($stmt->execute()){
            $this->returnDatas = $stmt->fetchAll();
            return $this->returnDatas;
        }else {
            return null;
        } 
    }

    public function register(array $datas): bool
    {
        // var_dump($post);
        $query = 'insert into utilisateur';
        $query .= ' (`nom`, `prenom`, `email`, `mdp`, `role`)';
        $query .= ' VALUES ("' . $datas['nom'] . '", "' . $datas['prenom'] . '", "' . $datas['email'] . '", "' . $datas['mdp'] . '", "0")';
        // var_dump($query);
        return $this->db->insert($query);
    }

    public function insertToken($email, $token){
        $query = 'update utilisateur';
        $query .= ' set `token`= "' . $token . '"';
        $query .= ' where email = "' . $email . '"';
        // var_dump($query);
        return $this->db->insert($query);
    }

    public function checkToken($email){
        $query = 'select token from utilisateur';
        $query .= ' where email = "' . $email . '"';
        // var_dump($query);
        return $this->db->query($query);
    }

    public function getRole($email){
        $query = 'select role from utilisateur';
        $query .= ' where email = "' . $email . '"';
        // var_dump($query);
        return $this->db->query($query);
    }

    public function checkEmail($email)
    {
        $query = 'select email from utilisateur';
        $query .= ' where email = "' . $email . '"';
        // var_dump($query);
        return $this->db->query($query);
    }

    public function getUserFromId($id)
    {
        $query = 'select nom,prenom from utilisateur';
        $query .= ' where id = "' . $id . '"';
        // var_dump($query);
        return $this->db->query($query);
    }

}
