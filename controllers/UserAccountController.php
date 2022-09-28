<?php

namespace Controllers;

use Controllers\core\MainController;


class UserAccountController extends MainController
{

    public function userAccountPage(): void
    {
        $id_user = $_SESSION['id'];
        $user = $this->account_model->getUser($id_user);
        $form['form']['last_name'] = $user[0]['nom'];
        $form['form']['first_name'] = $user[0]['prenom'];
        $email = $user[0]['email'];
        $form['form']['photo'] = $user[0]['photo'];
        
        if (!empty($_POST)) {
            $form = $this->checkDataForm($_POST);
            $image = $this->checkImage($_FILES);
            $error_image = !isset($image[0]) ? null : $image;
            if (!$form['errors'] && !$error_image) {
                $path_image = $this->uploadImage($image);
                $mdp = password_hash($form['form']['password'], PASSWORD_DEFAULT);
                $data = ['id' => $id_user,'nom' => $form['form']['last_name'], 'prenom' => $form['form']['first_name'], 'mdp' => $mdp, 'photo' => $path_image];
                $res = $this->account_model->update($data);
            }
            
        }

        $this->renderUserAccountPage($form ?? null, $res ?? null, $email ?? null, $error_image ?? []);
    }


    // $this->main_view = ./views/main.html/twig and is define in MainController
    public function renderUserAccountPage(array $form = null, bool $res = null, string $email, array $error_image): void
    {
        echo $this->twig->render($this->main_view, [
            'body' => 'twig/UserAccount.html.twig',
            'form' => $form,
            'res' => $res,
            'con' => $this->connected,
            'role' => $this->role,
            'email' => $email,
            'error_image' => $error_image
        ]);
    }


    public function checkDataForm(array $formData): ?array
    {
        $errors = [];
        $result = [];
        $form = [];
        foreach ($formData as $key => $value) {
            $value = htmlspecialchars($value);
            if ($value) { // SI VALEUR
                switch ($key) { // ON FAIT UN SWITCH POUR LES MSGS D'ERREURS
                    case 'first_name':
                        strlen($value) > 50 ? $errors[$key] = 'Votre nom est trop long' : $form[$key] = $value;
                        break;
                    case 'last_name':
                        strlen($value) > 50 ? $errors[$key] = 'Votre prénom est trop long' : $form[$key] = $value;
                        break;
                    case 'password':
                        strlen($value) > 50 || strlen($value) < 6 ? $errors[$key] = 'Votre mot de passe doit faire entre 6 et 50 caractères' : $form[$key] = $value;
                        break;
                    case 'confirm_password':
                        $value != $formData['password'] ? $errors[$key] = 'Veuillez renseigner le même mot de passe' : $form[$key] = $value;
                        break;
                    default:
                        break;
                }
            } else { // SI PAS DE VALEURS
                switch ($key) { // ON FAIT UN SWITCH POUR LES MSGS D'ERREURS
                    case 'first_name':
                        $errors[$key] = 'Veuillez renseigner votre nom';
                        break;
                    case 'last_name':
                        $errors[$key] = 'Veuillez renseigner votre prénom';
                        break;
                    case 'password':
                        $errors[$key] = 'Veuillez renseigner votre mot de passe';
                        break;
                    case 'confirm_password':
                        $errors[$key] = 'Veuillez renseigner la confirmation du mot de passe';
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
        $image = $image['photo'];
        if ($image['error'] == 4) {
            return $res['error'] = ['Veuillez renseigner une image'];
        } else if ($image['size'] > 10485760) { // 10 
            return $res['error'] = ['Image trop grande'];
        } else if ($image['type'] != 'image/jpeg' && $image['type'] != 'image/jpg' && $image['type'] != 'image/png' && $image['type'] != 'application/pdf') {
            return $res['error'] = ['Extension d\'image non autorisé'];
        } else {
            return $image;
        }
    }

    private function uploadImage(array $image): ?string
    {
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
