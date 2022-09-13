<?php

namespace Controllers;

use Controllers\core\MainController;
use Models\{
    PostsModel,
    CommentairesModel,
    AccountsModel
};


class PostController extends MainController
{

    private $postModel;

    public function post()
    {
        $this->postModel = new PostsModel();
        $this->comModel = new CommentairesModel();
        $this->accModel = new AccountsModel();
        $id_user = $_SESSION['id'];
        $id_post = $_GET['id'];
        // var_dump($id);
        $post = $this->postModel->getPost($id_post);
        $dbComment = $this->comModel->getCommentaire($post[0]['id']);
        $comment = isset($_POST['commentaire']) ? $_POST['commentaire'] : null;
        if($comment){
            $msg = $this->addCommentaire($comment, $id_post, $id_user);
        } else if ($comment === '') {
            $comment = 'error';
        }
        $this->renderPost($post ?? null, $msg ?? null, $comment, $dbComment ?? null);
    }

    public function addCommentaire($comment,$id_post, $id_user){
        $date = date("Y-m-d H:i:s", strtotime('+2 hours'));
        $result = $this->comModel->addCommentaire($comment, $id_post,$id_user, $date);
        if($result == false){
            $result = 'false';
        }
        return $result;
    }

    // $this->main_view = ./views/main.html/twig and is define in MainController
    public function renderPost($post, $msg, $comment, $dbComment)
    {
        echo $this->twig->render($this->main_view, [
            'body' => 'twig/Post.html.twig',
            'post' => $post[0],
            'msg' => $msg,
            'comment' => $comment,
            'dbComment' => $dbComment,
            'con' => $this->connected,
            'role' => $this->role
        ]);
    }
}
