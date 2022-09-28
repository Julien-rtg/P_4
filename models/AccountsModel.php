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
        $query = 'insert into utilisateur';
        $query .= ' (`nom`, `prenom`, `email`, `mdp`, `role`, `photo`)';
        $query .= ' VALUES ("' . $datas['nom'] . '", "' . $datas['prenom'] . '", "' . $datas['email'] . '", "' . $datas['mdp'] . '", "0", "Image-01-300x300.jpg")';
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

    public function getUser(string $id): ?array
    {
        $stmt = $this->conn->prepare('SELECT nom, prenom, email, mdp, photo FROM utilisateur WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
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

    public function update(array $datas): ?bool
    {
        $stmt = $this->conn->prepare('update utilisateur set nom = :nom, prenom = :prenom, mdp = :mdp, photo = :photo where id = :id');
        $stmt->bindParam(':nom', $datas['nom'], PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $datas['prenom'], PDO::PARAM_STR);
        $stmt->bindParam(':mdp', $datas['mdp'], PDO::PARAM_STR);
        $stmt->bindParam(':photo', $datas['photo'], PDO::PARAM_STR);
        $stmt->bindParam(':id', $datas['id'], PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        } else {
            return null;
        }
    }

}
