<?php

namespace Controllers\admin;

use Controllers\core\MainController;
use Models\PostsModel;


class AdminController extends MainController{

    public function adminPage($id=null){
        $this->postModel = new PostsModel();
        // $posts = $this->postModel->getAllBlogPosts();
        if($id){
            $del = $this->postModel->deletePost($id);
        }
        

        if (isset($_GET['page']) && !empty($_GET['page'])) { // ON RECUP LA PAGE
            $currentPage = (int) strip_tags($_GET['page']);
        } else {
            $currentPage = 1;
        }

        $countPosts = $this->postModel->countBlogPosts();
        $countPosts = intval($countPosts[0]['nb_posts']);
        // On détermine le nombre d'articles par page
        $perPage = 10;
        // On calcule le nombre de pages total
        $pages = ceil($countPosts / $perPage);
        $pages = intval($pages);
        $firstPost = ($currentPage * $perPage) - $perPage;
        $posts = $this->postModel->getLimitBlogPosts($firstPost, $perPage);

        $this->renderAdminPage($posts ?? null, $currentPage ?? null, $pages ?? null, $del ?? null);
    }

    // $this->main_view = ./views/main.html/twig and is define in MainController
    public function renderAdminPage($posts, $currentPage, $pages, $del)
    {
        // var_dump($del);
        echo $this->twig->render($this->main_view, [
            'body' => 'twig/admin/Admin.html.twig',
            'posts' => $posts,
            'currentPage' => $currentPage,
            'pages' => $pages,
            'retourDel' => $del
        ]);
    }

    public function deletePost($id){
        // header('Location: /p_4/admin');
        $this->adminPage($id);
    }

}