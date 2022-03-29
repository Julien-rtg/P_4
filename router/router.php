<?php
namespace Router;

use AltoRouter;
use Controllers\{
    AllBlogPostsController,
    HomePageController, 
    Page404Controller,
    PostController
};

class Router {

    private $router;

    public function __construct(){
        $this->router = new AltoRouter();
        $this->home = new HomePageController();
        $this->page_404 = new Page404Controller();
        $this->allBlogPosts = new AllBlogPostsController();
        $this->post = new PostController();
    }

    public function routeMap(){
        // $uri = $_SERVER['REQUEST_URI'];
        // echo $uri; // Outputs: URI
        
        // map homepage
        $this->router->map('GET|POST', '/p_4/', function () {
            $this->home->homePage();
        });

        // map all blog posts
        $this->router->map('GET|POST', '/p_4/posts', function () {
            $this->allBlogPosts->allBlogPosts();
        });

        // map post
        $this->router->map('GET|POST', '/p_4/post', function () {
            $this->post->post();
        });

        $match = $this->router->match();
        $this->checkMatch($match);
    }

    public function checkMatch($match){
        if (is_array($match) && is_callable($match['target'])) {
            call_user_func_array($match['target'], $match['params']);
        } else {
            // no route was matched throw 404
            // header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
            $this->page_404->renderPage404();
        }
    }

    
}

// dynamic named route
// $router->map('GET|POST', '/users/[i:id]/', function($id) {
//   require __DIR__ . '/views/user/details.php';
// }, 'user-details');