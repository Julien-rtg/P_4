<?php

namespace Models;

use Models\core\MainModel;
use PDO;


class PostsModel extends MainModel{

    public function getAllBlogPosts(): ?array
    {
        $query = 'select * from post';
        return $this->db->query($query);
    }

    public function countBlogPosts(): ?array
    {
        $query = 'SELECT COUNT(*) AS nb_posts FROM `post`';
        return $this->db->query($query);
    }

    public function getLimitBlogPosts(int $first, int $perPage): ?array
    {
        $stmt = $this->conn->prepare('SELECT * FROM `post` ORDER BY `date_maj` DESC LIMIT :first, :perPage');
        $stmt->bindParam(':first', $first, PDO::PARAM_INT);
        $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        } 
    }

    public function getPost(string $id): ?array
    {
        $stmt = $this->conn->prepare('select * from post WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        } 
    }

    public function addPost(string $post, string $path): ?bool
    {
        $query = 'insert into post';
        $query .= ' (`titre`, `image`, `chapo`, `contenu`, `id_utilisateur`)';
        $query .= ' VALUES ("'.$post['title'].'", "'.$path .'", "' . $post['chapo'] . '", "' . $post['comment'] . '", "1")';
        return $this->db->insert($query);
    }

    public function modifyPost(array $post, string $path): ?bool
    {
        $stmt = $this->conn->prepare('update post set titre = :title, image = :path, chapo = :chapo, contenu = :comment where id = :id');
        $stmt->bindParam(':title', $post['title'], PDO::PARAM_STR);
        $stmt->bindParam(':path', $path, PDO::PARAM_STR);
        $stmt->bindParam(':chapo', $post['chapo'], PDO::PARAM_STR);
        $stmt->bindParam(':comment', $post['comment'], PDO::PARAM_STR);
        $stmt->bindParam(':id', $post['id'], PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        } else {
            return null;
        } 
    }

    public function deletePost(string $id): ?bool
    {
        $stmt = $this->conn->prepare('delete from post WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        } else {
            return null;
        } 

    }
}
