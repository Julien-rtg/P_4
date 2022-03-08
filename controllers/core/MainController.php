<?php
namespace Controllers\core;

use Twig_Environment;
use Twig_Loader_Filesystem;
use Controllers\core\MailController;
use App\Database;

class MainController{
    protected $twig_loader;
    protected $twig;
    protected $main_view;
    protected $mail;
    protected $db;

    public function __construct(){
        $this->db = new Database();
        $this->twig_loader = new Twig_Loader_Filesystem('./views');
        $this->twig = new Twig_Environment($this->twig_loader);
        $this->main_view = 'main.html.twig';
        $this->mail = new MailController();
    }
    
}