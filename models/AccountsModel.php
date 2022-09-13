<?php

namespace Models;

use Models\core\MainModel;
use PDO;



class AccountsModel extends MainModel
{

    public function login(string $email): ?array
    {
        $stmt = $this->conn->prepare('SELECT id, mdp FROM utilisateur WHERE email = :email');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        if($stmt->execute()){
            return $stmt->fetchAll();
        }else {
            return null;
        } 
    }

    public function register(array $datas): ?bool
    {
        // var_dump($post);
        $query = 'insert into utilisateur';
        $query .= ' (`nom`, `prenom`, `email`, `mdp`, `role`)';
        $query .= ' VALUES ("' . $datas['nom'] . '", "' . $datas['prenom'] . '", "' . $datas['email'] . '", "' . $datas['mdp'] . '", "0")';
        // var_dump($query);
        return $this->db->insert($query);
    }

    public function insertToken(string $email, string $token): ?bool
    {
        $stmt = $this->conn->prepare('update utilisateur set token = :token where email = :email');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        } 
    }

    public function checkToken(string $email): ?array
    {
        $stmt = $this->conn->prepare('SELECT token FROM utilisateur WHERE email = :email');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        } 
    }

    public function getRole(string $email): ?array
    {
        $stmt = $this->conn->prepare('SELECT role FROM utilisateur WHERE email = :email');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        } 
    }

    public function checkEmail(string $email): ?array
    {
        $stmt = $this->conn->prepare('SELECT email FROM utilisateur WHERE email = :email');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        } 
    }

    public function getUserFromId(string $id): ?array
    {
        $stmt = $this->conn->prepare('SELECT nom,prenom FROM utilisateur WHERE email = :email');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        } 
    }

}
