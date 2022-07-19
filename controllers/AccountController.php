<?php

namespace Controllers;

use Controllers\core\MainController;


class AccountController extends MainController
{

    public function LoginPage()
    {


        $this->renderLoginPage($form ?? null);
    }

    // $this->main_view = ./views/main.html/twig and is define in MainController
    public function renderLoginPage($form = null)
    {
        echo $this->twig->render($this->main_view, [
            'body' => 'twig/LoginPage.html.twig',
            'form' => $form
        ]);
    }

    public function RegisterPage()
    {


        $this->renderRegisterPage($form ?? null);
    }

    // $this->main_view = ./views/main.html/twig and is define in MainController
    public function renderRegisterPage($form = null)
    {
        echo $this->twig->render($this->main_view, [
            'body' => 'twig/RegisterPage.html.twig',
            'form' => $form
        ]);
    }


}
