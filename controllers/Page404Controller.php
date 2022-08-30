<?php

namespace Controllers;

use Controllers\core\MainController;


class Page404Controller extends MainController
{

    // $this->main_view = ./views/main.html/twig and is define in MainController
    public function renderPage404()
    {
        echo $this->twig->render($this->main_view, [
            'body' => 'twig/Page404.html.twig',
            'con' => $this->connected,
            'role' => $this->role
        ]);
    }

}
