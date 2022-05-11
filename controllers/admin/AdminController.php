<?php

namespace Controllers\admin;

use Controllers\core\MainController;

class AdminController extends MainController{

    public function adminPage(){
        
        $this->renderAdminPage();
    }

    // $this->main_view = ./views/main.html/twig and is define in MainController
    public function renderAdminPage()
    {
        echo $this->twig->render($this->main_view, [
            'body' => 'twig/admin/Admin.html.twig',
        ]);
    }

}