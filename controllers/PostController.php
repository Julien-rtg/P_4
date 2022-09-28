<?php

namespace Controllers;

use Controllers\core\MainController;
use Models\{
    PostsModel,
    CommentsModel,
    AccountsModel
};


class PostController extends MainController
{

    private $postModel;

    public function post(): void
    {
        $this->postModel = new PostsModel();
        $this->comModel = new CommentsModel();
        $this->accModel = new AccountsModel();
        $id_user = $_SESSION['id'];
        $id_post = $_GET['id'];
        $post = $this->postModel->getPost($id_post);
        $dbComment = $this->comModel->getCommentaire($post[0]['id']);
        $comment = isset($_POST['commentaire']) ? $_POST['commentaire'] : '';
        if($comment){
            $msg = $this->addCommentaire($comment, $id_post, $id_user);
            if(!$msg){
                $comment = 'error';
            }
        }
        $this->renderPost($post ?? null, $msg ?? false, $comment, $dbComment ?? null);
    }

    public function addCommentaire(string $comment,string $id_post, string $id_user): bool
    {
        $date = date("Y-m-d H:i:s", strtotime('+2 hours'));
        $result = $this->comModel->addCommentaire($comment, $id_post,$id_user, $date);
        return $result;
    }

    // $this->main_view = ./views/main.html/twig and is define in MainController
    public function renderPost(array $post, bool $msg, string $comment, array $dbComment): void
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
