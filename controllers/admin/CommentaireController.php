<?php

namespace Controllers\admin;

use Controllers\core\MainController;

use Models\CommentairesModel;

class CommentaireController extends MainController
{

    public function commentairePage(bool $valid=false, bool $reject=false): void
    {
        $this->model = new CommentairesModel();
        $com = $this->model->getUnvalidateComment();

        $this->renderCommentairePage($com, $valid, $reject);
    }


    // $this->main_view = ./views/main.html/twig and is define in MainController
    public function renderCommentairePage(array $com, bool $valid, bool $reject): void
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

    public function confirmCom(string $id): void
    {
        $this->model = new CommentairesModel();
        $res = $this->model->validateCom($id);
        $this->commentairePage($res);
    }

    public function rejectCom(string $id): void
    {
        $this->model = new CommentairesModel();
        $res = $this->model->rejectCom($id);
        $this->commentairePage(false,$res);
    }

}
