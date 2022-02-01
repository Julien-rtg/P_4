<?php
namespace Controllers;

use App\Controllers\MainController;


class HomePageController extends MainController {

    // $this->main_view = ./views/main.html/twig and is define in MainController
    public function homePage(){
        echo $this->twig->render($this->main_view, [
            'body' => 'twig/HomePage.html.twig'
        ]);
    }

}