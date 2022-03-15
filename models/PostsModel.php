<?php

namespace Models;

use Models\core\MainModel;

class PostsModel extends MainModel{

    public function getAllBlogPosts(){
        $query = 'select * from post';
        return $this->db->query($query);
    }

}