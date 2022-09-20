<?php

namespace Controllers\admin;

use Controllers\core\MainController;

use Models\PostsModel;

class AdminPostController extends MainController{

    public function addPost(array $post=[]): void
    {
        $this->postModel = new PostsModel();
        if($post){
            $form['form']['title'] = $post[0]['titre'];
            $form['form']['chapo'] = $post[0]['chapo'];
            $form['form']['comment'] = $post[0]['contenu'];
            $form['form']['image'] = $post[0]['image'];

            $modify = true;
        }
        if (!empty($_POST)) {
            $form = $this->checkDataPostForm($_POST);
            if(isset($modify)) $form['form']['id'] = $post[0]['id'];
            $image = $this->checkImage($_FILES);
            $error_image = !isset($image[0]) ? null : $image;
            if (!$form['errors'] && !is_string($image)) {
                $path_image = $this->uploadImage($image);
                if(isset($modify)){
                    $resMod = $this->postModel->modifyPost($form['form'], $path_image);
                }else {
                    $res = $this->postModel->addPost($form['form'], $path_image);
                }
            }
        }
        $this->renderAddPage($form ?? [], $error_image ?? [], $res ?? false, $modify ?? false, $resMod ?? false);
    }

    public function modifyPost(string $id): void
    {
        $this->postModel = new PostsModel();
        $post = $this->postModel->getPost($id);
        $this->addPost($post);
    }

    // $this->main_view = ./views/main.html/twig and is define in MainController
    public function renderAddPage(array $form, array $error_image, bool $retourAdd, bool $mod, bool $retourMod): void
    {
        echo $this->twig->render($this->main_view, [
            'body' => 'twig/admin/AddPost.html.twig',
            'form' => $form,
            'error_image' => $error_image,
            'retourAdd' => $retourAdd,
            'mod' => $mod,
            'retourMod' => $retourMod,
            'con' => $this->connected,
            'role' => $this->role
        ]);
    }

    private function checkDataPostForm(array $formData): ?array
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
                        strlen($value) > 15000 ? $errors[$key] = 'Votre commentaire est trop long' : $form[$key] = $value;
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

    private function checkImage(array $image): ?array
    {
        $image = $image['image'];
        if($image['error'] == 4){
            return $res['error'] = ['Veuillez renseigner une image'];
        } else if($image['size'] > 10485760){ // 10 
            return $res['error'] = ['Image trop grande'];
        } else if ($image['type'] != 'image/jpeg' && $image['type'] != 'image/jpg' && $image['type'] != 'image/png' && $image['type'] != 'application/pdf'){
            return $res['error'] = ['Extension d\'image non autorisé'];
        } else {
            return $image;
        }
    }

    private function uploadImage(array $image): ?string
    {
        // var_dump($image);
        $uploadDir = 'ressources/img/';
        $fileNameCmps = explode(".", $image['name']);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = md5(time() . $image['name']) . '.' . $fileExtension;
        $uploadFile = $uploadDir . $newFileName;
        if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
            return $newFileName;
        }
    }

}
