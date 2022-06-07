<?php

namespace Controllers\admin;

use Controllers\core\MainController;

use Models\PostsModel;

class AddPostController extends MainController{

    public function addPost()
    {
        $this->postModel = new PostsModel();
        if (!empty($_POST)) {
            $form = $this->checkDataPostForm($_POST);
            $image = $this->checkImage($_FILES);
            $error_image = !is_string($image) ? null : $image;
            if (!$form['errors'] && !is_string($image)) {
                $path_image = $this->uploadImage($image);
                // $res = $this->postModel->addPost($form, $path_image);
            }
        }
        $this->renderAddPage($form ?? null, $error_image ?? null);
    }

    // $this->main_view = ./views/main.html/twig and is define in MainController
    public function renderAddPage($form, $error_image)
    {
        echo $this->twig->render($this->main_view, [
            'body' => 'twig/admin/AddPost.html.twig',
            'form' => $form,
            'error_image' => $error_image
        ]);
    }

    private function checkDataPostForm($formData)
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
                    default:
                        break;
                }
            }
        }
        return $result[] = ['errors' => $errors, 'form' => $form];
    }

    private function checkImage($image){
        $image = $image['image'];
        // var_dump($image);
        if($image['error'] == 4){
            return $res['error'] = 'Veuillez renseigner une image';
        } else if($image['size'] > 10485760){ // 10 
            return $res['error'] = 'Image trop grande';
        } else if ($image['type'] != 'image/jpeg' && $image['type'] != 'image/jpg' && $image['type'] != 'image/png' && $image['type'] != 'application/pdf'){
            return $res['error'] = 'Extension d\'image non autorisé';
        } else {
            return $image;
        }
    }

    private function uploadImage($image){
        $uploadDir = 'ressources/img/';
        $fileNameCmps = explode(".", $image['name']);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = md5(time() . $image['name']) . '.' . $fileExtension;
        $uploadFile = $uploadDir . $newFileName;
        // var_dump($file_name);
        // var_dump($image);
        if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
            return $image['name'];
        }
    }

}