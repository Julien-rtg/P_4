<?php
namespace Router;

use AltoRouter;
use Controllers\{
    AllBlogPostsController,
    HomePageController, 
    Page404Controller,
    PostController,
    AccountController,
    
};
use Controllers\admin\{
    AdminController,
    AdminPostController,
    CommentaireController
};
use Controllers\core\MainController;

class Router {

    private $router;

    public function __construct(){
        $this->router = new AltoRouter();
        $this->home = new HomePageController();
        $this->account = new AccountController();
        $this->page_404 = new Page404Controller();
        $this->allBlogPosts = new AllBlogPostsController();
        $this->post = new PostController();
        $this->admin = new AdminController();
        $this->adminAdd = new AdminPostController();
        $this->mainController = new MainController();
        $this->commentaireController = new CommentaireController();
    }

    public function routeMap(): void
    {
        $uri = $_SERVER['REQUEST_URI'];
        if($this->mainController->getConnection()){
            // map loginpage
            $this->router->map('GET|POST', '/p_4/login', function () {
                $this->account->LoginPage();
            });
    
            // map registerpage
            $this->router->map('GET|POST', '/p_4/register', function () {
                $this->account->RegisterPage();
            });
    
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
            if($this->mainController->getRole()){
                // map admin accueil
                $this->router->map('GET|POST', '/p_4/admin', function () {
                    $this->admin->adminPage();
                });

                // map commentaires validation
                $this->router->map('GET|POST', '/p_4/commentaires', function () {
                    $this->commentaireController->commentairePage();
                });
        
                // map admin add post
                $this->router->map('GET|POST', '/p_4/add_post', function () {
                    $this->adminAdd->addPost();
                });
        
                // map admin modify post
                $this->router->map('GET|POST', '/p_4/modify_post/[i:id]', function ($id) {
                    $this->adminAdd->modifyPost($id);
                });
        
                // map admin delete post
                $this->router->map('GET|POST', '/p_4/delete_post/[i:id]', function ($id) {
                    $this->admin->deletePost($id);
                });

                // map admin confirm com
                $this->router->map('GET|POST', '/p_4/confirm/[i:id]', function ($id) {
                    $this->commentaireController->confirmCom($id);
                });
        
                // map admin reject com
                $this->router->map('GET|POST', '/p_4/reject/[i:id]', function ($id) {
                    $this->commentaireController->rejectCom($id);
                });
            }
    
            // map disconnect
            $this->router->map('GET|POST', '/p_4/disconnect', function () {
                $this->account->disconnect();
            });
            
        } else {
            // var_dump($uri);
            if($uri != '/p_4/login' && $uri != '/p_4/register'){
                header('Location: /p_4/login');
            }
            // map loginpage
            $this->router->map('GET|POST', '/p_4/login', function () {
                $this->account->loginPage();
            });

            // map registerpage
            $this->router->map('GET|POST', '/p_4/register', function () {
                $this->account->registerPage();
            });

        }
        $match = $this->router->match();
        $this->checkMatch($match);
    }

    public function checkMatch($match): void
    {
        if (is_array($match) && is_callable($match['target'])) {
            call_user_func_array($match['target'], $match['params']);
        } else {
            // no route was matched throw 404
            $this->page_404->renderPage404();
        }
    }

    
}
