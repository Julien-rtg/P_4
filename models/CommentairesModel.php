<?php

namespace Models;

use Models\core\MainModel;

class CommentairesModel extends MainModel
{

    public function getUnvalidateComment(){
        $query = 'select post.titre, commentaire.id,commentaire.id_post,commentaire.id_utilisateur, commentaire.contenu, commentaire.date, utilisateur.nom, utilisateur.prenom from commentaire';
        $query .= ' inner join utilisateur on commentaire.id_utilisateur = utilisateur.id';
        $query .= ' inner join post on commentaire.id_post = post.id';
        $query .= ' where valider = 0';
        // var_dump($query);
        return $this->db->query($query);
    }
    public function getCommentaire($id_post){
        $query = 'select distinct commentaire.id,commentaire.id_post,commentaire.id_utilisateur, commentaire.contenu, commentaire.date, utilisateur.nom, utilisateur.prenom from commentaire';
        $query .= ' inner join utilisateur on commentaire.id_utilisateur = utilisateur.id';
        $query .= ' inner join post on commentaire.id_post = ' . $id_post;
        $query .= ' where commentaire.valider = 1';
        return $this->db->query($query);
    }

    public function addCommentaire($comment, $id_post, $id_user, $date)
    {
        $query = 'insert into commentaire';
        $query .= ' (`id_post`, `id_utilisateur`, `contenu`, `date`, `valider`)';
        $query .= ' VALUES ('.$id_post.', '.$id_user.', "'.$comment.'", "'.$date.'", 0)';
        // var_dump($query);
        return $this->db->insert($query);
    }

    public function validateCom($id){
        $query = 'update commentaire';
        $query .= ' set `valider` = "1"';
        $query .= ' where id = ' . $id;
        return $this->db->insert($query);
    }

    public function rejectCom($id){
        $query = 'delete from commentaire';
        $query .= ' where id = ' . $id;
        // var_dump($query);
        if ($this->db->insert($query)) {
            return true;
        } else {
            return false;
        }
    }
}
