<?php

namespace Models;

use Models\core\MainModel;

class CommentairesModel extends MainModel
{

    public function getCommentaire($id_post){
        $query = 'select * from commentaire';
        $query .= ' where id_post = '.$id_post;
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
