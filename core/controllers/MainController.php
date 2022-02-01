<?php
namespace App\Controllers;

use Twig_Environment;
use Twig_Loader_Filesystem;

class MainController{
    protected $twig_loader;
    protected $twig;
    protected $main_view;

    public function __construct()
    {
        $this->twig_loader = new Twig_Loader_Filesystem('./views');
        $this->twig = new Twig_Environment($this->twig_loader);
        $this->main_view = 'main.html.twig';
    }
    
}