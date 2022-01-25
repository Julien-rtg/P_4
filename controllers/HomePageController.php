<?php
namespace Controllers;

use Twig_Environment;
use Twig_Loader_Filesystem;

class HomePageController {

    public $twig_loader;
    public $twig;

    public function __construct(){
        $this->twig_loader = new Twig_Loader_Filesystem('./views');
        $this->twig = new Twig_Environment($this->twig_loader);
    }

    public function homePage(){
        echo $this->twig->render('HomePage.html.twig');
    }

}