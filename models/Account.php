<?php


class Account
{
    public int $id;
    public string $nom;
    public string $prenom;
    public string $email;
    public string $mdp;
    public int $role;
    public string $photo;


    public function __construct(int $id, string $nom, string $prenom, string $email, string $mdp, int $role, string $photo)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mdp = $mdp;
        $this->role = $role;
        $this->photo = $photo;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom(){
        return $this->nom;
    }

    public function setNom($nom){
        $this->nom = $nom;
    }

    public function getPrenom(){
        return $this->prenom;
    }

    public function setPrenom($prenom){
        $this->prenom = $prenom;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->nom = $email;
    }

    public function getMdp(){
        return $this->mdp;
    }

    public function setMdp($mdp){
        $this->mdp = $mdp;
    }

    public function getRole(){
        return $this->role;
    }

    public function setRole($role){
        $this->role = $role;
    }

    public function getPhoto(){
        return $this->photo;
    }

    public function setPhoto($photo){
        $this->photo = $photo;
    }

}