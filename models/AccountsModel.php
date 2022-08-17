<?php

namespace Models;

use Models\core\MainModel;

class AccountsModel extends MainModel
{


    public function getPost($id)
    {
        $query = 'select * from post';
        $query .= ' where id = ' . $id;
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

}
