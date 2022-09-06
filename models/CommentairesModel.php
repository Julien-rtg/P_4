<?php

namespace Models;

use Models\core\MainModel;

class CommentairesModel extends MainModel
{

    public function getCommentaire($id_post){
        $query = 'select commentaire.id,commentaire.id_post,commentaire.id_utilisateur, commentaire.contenu, commentaire.date, utilisateur.nom, utilisateur.prenom from commentaire';
        $query .= ' inner join utilisateur on commentaire.id_utilisateur = utilisateur.id';
        $query .= ' and id_post = '.$id_post . ' and valider = 1';
        return $this->db->query($query);
    }

    public function addCommentaire($comment, $id_post, $date)
    {
        $query = 'insert into commentaire';
        $query .= ' (`id_post`, `id_utilisateur`, `contenu`, `date`, `valider`)';
        $query .= ' VALUES ('.$id_post.', 1, "'.$comment.'", "'.$date.'", 0)';
        // var_dump($query);
        return $this->db->insert($query);
    }
}
