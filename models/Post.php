<?php


class Post
{
    public int $id;
    public string $titre;
    public string $chapo;
    public string $contenu;
    public int $id_utilisateur;
    public string $date_maj;


    public function __construct(int $id,string $titre, string $chapo, string $contenu, int $id_utilisateur, string $date_maj)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->chapo = $chapo;
        $this->contenu = $contenu;
        $this->id_utilisateur = $id_utilisateur;
        $this->date_maj = $date_maj;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function getChapo()
    {
        return $this->chapo;
    }

    public function setChapo($chapo)
    {
        $this->chapo = $chapo;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    public function getIdUtilisateur()
    {
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;
    }

    public function getDateMaj()
    {
        return $this->date_maj;
    }

    public function setDateMaj($date_maj)
    {
        $this->date_maj = $date_maj;
    }
}
