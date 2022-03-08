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
            if($value){ // SI VALEUR
                if($key == 'email'){ // REGEX MAIL
                    if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $form[$key] = $value;
                    } else {
                        $errors[$key] = 'Veuillez renseigner une email valide';
                    }
                }else { // ON REGARDE LA TAILLE DES VALEURS
                    switch ($key) { // ON FAIT UN SWITCH POUR LES MSGS D'ERREURS
                        case 'first_name':
                            strlen($value) > 30 ? $errors[$key] = 'Votre nom est trop long' : $form[$key] = $value;
                            break;
                        case 'last_name':
                            strlen($value) > 30 ? $errors[$key] = 'Votre prénom est trop long' : $form[$key] = $value;
                            break;
                        case 'object':
                            strlen($value) > 255 ? $errors[$key] = 'Votre objet est trop long' : $form[$key] = $value;
                            break;
                        case 'message':
                            strlen($value) > 65000 ? $errors[$key] = 'Votre message est trop long' : $form[$key] = $value;
                            break;
                        default:
                            break;
                    }
                }
            } else { // SI PAS DE VALEURS
                switch($key){ // ON FAIT UN SWITCH POUR LES MSGS D'ERREURS
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