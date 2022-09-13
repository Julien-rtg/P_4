<?php

namespace Models;

use Models\core\MainModel;
use PDO;

class CommentairesModel extends MainModel
{

    public function getUnvalidateComment(): ?array
    {
        $query = 'select post.titre, commentaire.id,commentaire.id_post,commentaire.id_utilisateur, commentaire.contenu, commentaire.date, utilisateur.nom, utilisateur.prenom from commentaire';
        $query .= ' inner join utilisateur on commentaire.id_utilisateur = utilisateur.id';
        $query .= ' inner join post on commentaire.id_post = post.id';
        $query .= ' where valider = 0';
        // var_dump($query);
        return $this->db->query($query);
    }
    public function getCommentaire(string $id_post): ?array
    {
        $query = 'select distinct commentaire.id,commentaire.id_post,commentaire.id_utilisateur, commentaire.contenu, commentaire.date, utilisateur.nom, utilisateur.prenom from commentaire';
        $query .= ' inner join utilisateur on commentaire.id_utilisateur = utilisateur.id';
        $query .= ' inner join post on commentaire.id_post = ' . $id_post;
        $query .= ' where commentaire.valider = 1';
        return $this->db->query($query);
    }

    public function addCommentaire(string $comment, string $id_post, string $id_user, string $date): ?bool
    {
        $query = 'insert into commentaire';
        $query .= ' (`id_post`, `id_utilisateur`, `contenu`, `date`, `valider`)';
        $query .= ' VALUES ('.$id_post.', '.$id_user.', "'.$comment.'", "'.$date.'", 0)';
        // var_dump($query);
        return $this->db->insert($query);
    }

    public function validateCom(string $id): ?bool
    {
        $stmt = $this->conn->prepare('update commentaire set valider = 1 WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        } 
    }

    public function rejectCom(string $id): ?bool
    {
        $stmt = $this->conn->prepare('delete from commentaire WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        } 
    }
}
