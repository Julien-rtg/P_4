<?php
namespace Router;

use AltoRouter;
use Controllers\HomePageController;

class Router {

    public $router;
    public $home;

    public function __construct(){
        $this->router = new AltoRouter();
        $this->home = new HomePageController();
    }

    public function routeMap(){
        // $uri = $_SERVER['REQUEST_URI'];
        // echo $uri; // Outputs: URI
        
        // map homepage
        $this->router->map('GET', '/p_4/', function () {
            $this->home->homePage();
        });

        //

        $match = $this->router->match();
        $this->checkMatch($match);
    }

    public function checkMatch($match){
        if (is_array($match) && is_callable($match['target'])) {
            call_user_func_array($match['target'], $match['params']);
        } else {
            // no route was matched throw 404
            header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        }
    }

    
}

// dynamic named route
// $router->map('GET|POST', '/users/[i:id]/', function($id) {
//   require __DIR__ . '/views/user/details.php';
// }, 'user-details');