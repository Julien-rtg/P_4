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

}