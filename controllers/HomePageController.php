<?php
namespace Controllers;

use Controllers\core\MainController;


class HomePageController extends MainController {

    public function homePage(){
        if(!empty($_POST)){
            $form = $this->checkDataContactForm($_POST);
            if(!$form['errors']){
                $mail = $this->mail->sendMail($form['form']);
            }
            // var_dump($form);
        }

        $this->renderHomePage($form ?? null, $mail ?? null);
    }
    
    // $this->main_view = ./views/main.html/twig and is define in MainController
    public function renderHomePage($form = null, $mail = null){
        echo $this->twig->render($this->main_view, [
            'body' => 'twig/HomePage.html.twig',
            'form' => $form,
            'mail' => $mail
        ]);
    }

    public function checkDataContactForm($formData){
        $errors = [];
        $result = [];
        $form = [];
        foreach($formData as $key=>$value){
            $value = htmlspecialchars($value);
            if($value){
                if($key == 'email'){
                    if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $form[$key] = $value;
                    } else {
                        $errors[$key] = 'Veuillez renseigner une email valide';
                    }
                }else {
                    $form[$key] = $value;
                }
            } else {
                switch($key){ // ON FAIT UN SWITCH POUR TRADUIRE LE NOM DE L'INPUT EN FRANCAIS
                    case 'first_name':
                        $errors[$key] = 'Veuillez renseigner votre nom';
                        break;
                    case 'last_name':
                        $errors[$key] = 'Veuillez renseigner votre prénom';
                        break;
                    case 'email':
                        $errors[$key] = 'Veuillez renseigner votre email';
                        break;
                    case 'object':
                        $errors[$key] = 'Veuillez renseigner l\'objet du message';
                        break;
                    case 'message':
                        $errors[$key] = 'Veuillez renseigner le message';
                        break;
                    default :
                        break;
                }
            }
        }
        return $result[] = ['errors' => $errors, 'form'=>$form];
    }

}