<?php

namespace Controllers\admin;

use Controllers\core\MainController;

class AddPostController extends MainController{

    public function addPost()
    {
        if (!empty($_POST)) {
            $form = $this->checkDataPostForm($_POST);
            if (!$form['errors']) {
                // ADD POST
            }
        }
        $this->renderAddPage($form ?? null);
    }

    // $this->main_view = ./views/main.html/twig and is define in MainController
    public function renderAddPage($form)
    {
        echo $this->twig->render($this->main_view, [
            'body' => 'twig/admin/AddPost.html.twig',
            'form' => $form,
        ]);
    }

    public function checkDataPostForm($formData)
    {
        $errors = [];
        $result = [];
        $form = [];
        foreach ($formData as $key => $value) {
            $value = htmlspecialchars($value);
            if ($value) { // SI VALEUR
                switch ($key) { // ON FAIT UN SWITCH POUR LES MSGS D'ERREURS
                    case 'title':
                        strlen($value) > 30 ? $errors[$key] = 'Votre titre est trop long' : $form[$key] = $value;
                        break;
                    case 'chapo':
                        strlen($value) > 30 ? $errors[$key] = 'Votre chapo est trop long' : $form[$key] = $value;
                        break;
                    case 'comment':
                        strlen($value) > 255 ? $errors[$key] = 'Votre commentaire est trop long' : $form[$key] = $value;
                        break;
                    case 'image':
                        
                        break;
                    default:
                        break;
                }
            } else { // SI PAS DE VALEURS
                switch ($key) { // ON FAIT UN SWITCH POUR LES MSGS D'ERREURS
                    case 'title':
                        $errors[$key] = 'Veuillez renseigner votre titre';
                        break;
                    case 'chapo':
                        $errors[$key] = 'Veuillez renseigner votre chapo';
                        break;
                    case 'comment':
                        $errors[$key] = 'Veuillez renseigner votre commentaire';
                        break;
                    case 'image':
                        $errors[$key] = 'Veuillez renseigner votre image';
                        break;
                    default:
                        break;
                }
            }
        }
        return $result[] = ['errors' => $errors, 'form' => $form];
    }

}