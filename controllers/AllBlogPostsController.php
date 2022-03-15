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
        $posts = $this->postModel->getAllBlogPosts();
        $this->renderAllBlogPosts($posts ?? null);
    }

    // $this->main_view = ./views/main.html/twig and is define in MainController
    public function renderAllBlogPosts($posts)
    {
        echo $this->twig->render($this->main_view, [
            'body' => 'twig/AllBlogPosts.html.twig',
            'posts' => $posts
        ]);
    }

}
