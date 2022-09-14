<?php

namespace Controllers\admin;

use Controllers\core\MainController;
use Models\PostsModel;


class AdminController extends MainController{

    public function adminPage(bool $del=false): void
    {
        $this->postModel = new PostsModel();
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
    public function renderAdminPage(array $posts, string $currentPage, string $pages, bool $del): void
    {
        echo $this->twig->render($this->main_view, [
            'body' => 'twig/admin/Admin.html.twig',
            'posts' => $posts,
            'currentPage' => $currentPage,
            'pages' => $pages,
            'retourDel' => $del,
            'con' => $this->connected,
            'role' => $this->role
        ]);
    }

    public function deletePost(string $id): void
    {
        $this->postModel = new PostsModel();
        $del = $this->postModel->deletePost($id);
        $this->adminPage($del);
    }
}
