<?php

namespace Controllers\admin;

use Controllers\core\MainController;

use Models\CommentairesModel;

class CommentaireController extends MainController
{

    public function commentairePage($valid=null, $reject=null)
    {
        // var_dump($res);
        $this->model = new CommentairesModel();
        $com = $this->model->getUnvalidateComment();

        $this->renderCommentairePage($com, $valid, $reject);
    }


    // $this->main_view = ./views/main.html/twig and is define in MainController
    public function renderCommentairePage($com, $valid, $reject)
    {
        echo $this->twig->render($this->main_view, [
            'body' => 'twig/admin/Commentaire.html.twig',
            'commentaires' => $com,
            'con' => $this->connected,
            'role' => $this->role,
            'valid' => $valid,
            'reject' => $reject
        ]);
    }

    public function confirmCom($id){
        $this->model = new CommentairesModel();
        $res = $this->model->validateCom($id);
        $this->commentairePage($res);
    }

    public function rejectCom($id){
        $this->model = new CommentairesModel();
        $res = $this->model->rejectCom($id);
        $this->commentairePage(false,$res);
    }

}
