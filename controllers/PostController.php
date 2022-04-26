<?php

namespace Controllers;

use Controllers\core\MainController;
use Models\{
    PostsModel,
    CommentairesModel
};


class PostController extends MainController
{

    private $postModel;

    public function post()
    {
        $this->postModel = new PostsModel();
        $this->comModel = new CommentairesModel();
        $id = isset($_GET['id']) ?  $_GET['id'] : 0;
        $post = $this->postModel->getPost($id);

        $comment = isset($_POST['commentaire']) ? $_POST['commentaire'] : null;
        if($comment){
            $msg = $this->addCommentaire($comment, $id);
        } else if ($comment === '') {
            $comment = 'error';
        }
        $this->renderPost($post ?? null, $msg ?? null, $comment);
    }

    public function addCommentaire($comment, $id){
        $date = date("Y-m-d H:i:s", strtotime('+2 hours'));
        $result = $this->comModel->addCommentaire($comment, $id, $date);
        if($result == false){
            $result = 'false';
        }
        return $result;
    }

    // $this->main_view = ./views/main.html/twig and is define in MainController
    public function renderPost($post, $msg, $comment)
    {
        echo $this->twig->render($this->main_view, [
            'body' => 'twig/Post.html.twig',
            'post' => $post[0],
            'msg' => $msg,
            'comment' => $comment
        ]);
    }
}
