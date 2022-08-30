<?php

namespace Models;

use Models\core\MainModel;

class AccountsModel extends MainModel
{


    public function login($email)
    {
        $query = 'select mdp from utilisateur';
        $query .= ' where email = "' . $email . '"';
        // var_dump($query);
        return $this->db->query($query);
    }

    public function register($datas)
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

}
