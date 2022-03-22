<?php

namespace Controllers;

use Controllers\core\MainController;
use Models\PostsModel;


class AllBlogPostsController extends MainController
{

    private $postModel;


    public function allBlogPosts()
    {
        $this->postModel = new PostsModel();
        // $posts = $this->postModel->getAllBlogPosts();

        if (isset($_GET['page']) && !empty($_GET['page'])) { // ON RECUP LA PAGE
            $currentPage = (int) strip_tags($_GET['page']);
        } else {
            $currentPage = 1;
        }

        $countPosts = $this->postModel->countBlogPosts();
        $countPosts = intval($countPosts[0]['nb_posts']);
        // On détermine le nombre d'articles par page
        $perPage = 5;
        // On calcule le nombre de pages total
        $pages = ceil($countPosts / $perPage);
        $firstPost = ($currentPage * $perPage) - $perPage;
        $posts = $this->postModel->getLimitBlogPosts($firstPost, $perPage);

        $this->renderAllBlogPosts($posts ?? null, $currentPage ?? null, $pages??null);
    }

    // $this->main_view = ./views/main.html/twig and is define in MainController
    public function renderAllBlogPosts($posts, $currentPage, $pages)
    {
        echo $this->twig->render($this->main_view, [
            'body' => 'twig/AllBlogPosts.html.twig',
            'posts' => $posts,
            'currentPage' => $currentPage,
            'pages' => $pages
        ]);
    }

}
