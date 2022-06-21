<?php
namespace Router;

use AltoRouter;
use Controllers\{
    AllBlogPostsController,
    HomePageController, 
    Page404Controller,
    PostController
};
use Controllers\admin\{
    AdminController,
    AdminPostController
};

class Router {

    private $router;

    public function __construct(){
        $this->router = new AltoRouter();
        $this->home = new HomePageController();
        $this->page_404 = new Page404Controller();
        $this->allBlogPosts = new AllBlogPostsController();
        $this->post = new PostController();
        $this->admin = new AdminController();
        $this->adminAdd = new AdminPostController();
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

        // map admin accueil
        $this->router->map('GET|POST', '/p_4/admin', function () {
            $this->admin->adminPage();
        });

        // map admin add post
        $this->router->map('GET|POST', '/p_4/add_post', function () {
            $this->adminAdd->addPost();
        });

        // map admin modify post
        $this->router->map('GET|POST', '/p_4/modify_post/[i:id]', function ($id) {
            $this->adminAdd->modifyPost($id);
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