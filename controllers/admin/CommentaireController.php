<?php

namespace Controllers\admin;

use Controllers\core\MainController;

use Models\CommentairesModel;

class CommentaireController extends MainController
{

    public function commentairePage()
    {
        $this->model = new CommentairesModel();
        $com = $this->model->getUnvalidateComment();
        var_dump($com);

        $this->renderCommentairePage($com);
    }


    // $this->main_view = ./views/main.html/twig and is define in MainController
    public function renderCommentairePage($com)
    {
        echo $this->twig->render($this->main_view, [
            'body' => 'twig/admin/Commentaire.html.twig',
            'com' => $com,
            'con' => $this->connected,
            'role' => $this->role

        ]);
    }

}
