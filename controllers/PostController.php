<?php

namespace Controllers;

use Controllers\core\MainController;
use Models\PostsModel;


class PostController extends MainController
{

    private $postModel;

    public function post()
    {
        $this->postModel = new PostsModel();
        $id = isset($_GET['id']) ?  $_GET['id'] : 0;
        $post = $this->postModel->getPost($id);

        $this->renderPost($post ?? null);
    }

    // $this->main_view = ./views/main.html/twig and is define in MainController
    public function renderPost($post)
    {
        echo $this->twig->render($this->main_view, [
            'body' => 'twig/Post.html.twig',
            'post' => $post[0],
        ]);
    }
}
