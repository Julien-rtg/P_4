<?php


class Comment
{
    public int $id;
    public int $id_post;
    public int $id_utilisateur;
    public string $contenu;
    public string $date;


    public function __construct(int $id, int $id_post, int $id_utilisateur, string $contenu, string $date)
    {
        $this->id = $id;
        $this->id_post = $id_post;
        $this->id_utilisateur = $id_utilisateur;
        $this->contenu = $contenu;
        $this->date = $date;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdPost()
    {
        return $this->id_post;
    }

    public function setIdPost($id_post)
    {
        $this->id_post = $id_post;
    }

    public function getIdUtilisateur()
    {
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

}
