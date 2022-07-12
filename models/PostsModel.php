<?php

namespace Models;

use Models\core\MainModel;

class PostsModel extends MainModel{

    public function getAllBlogPosts(){
        $query = 'select * from post';
        return $this->db->query($query);
    }

    public function countBlogPosts(){
        $query = 'SELECT COUNT(*) AS nb_posts FROM `post`';
        return $this->db->query($query);
    }

    public function getLimitBlogPosts($first, $perPage)
    {
        $query = 'SELECT * FROM `post` ORDER BY `date_maj` DESC LIMIT '.$first.','.$perPage;
        return $this->db->query($query);
    }

    public function getPost($id){
        $query = 'select * from post';
        $query .= ' where id = '.$id;
        return $this->db->query($query);
    }

    public function addPost($post, $path){
        // var_dump($post);
        $query = 'insert into post';
        $query .= ' (`titre`, `image`, `chapo`, `contenu`, `id_utilisateur`)';
        $query .= ' VALUES ("'.$post['title'].'", "'.$path .'", "' . $post['chapo'] . '", "' . $post['comment'] . '", "1")';
        // var_dump($query);
        return $this->db->insert($query);
    }

    public function modifyPost($post, $path){
        // var_dump($post);
        $query = 'update post';
        $query .= ' set `titre` = "' . $post['title'] . '", `image` = "' . $path . '", `chapo` = "' . $post['chapo'] . '", `contenu` = "' . $post['comment'] . '"';
        $query .= ' where id = ' . $post['id'];
        // var_dump($query);
        return $this->db->insert($query);
    }

    public function deletePost($id){
        $query = 'delete from post';
        $query .= ' where id = ' . $id;
        // var_dump($query);
        if($this->db->insert($query)){
            return true;
        }else {
            return false;
        }

    }

}