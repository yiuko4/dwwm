<?php
require_once("./controllers/MainController.controller.php");
require_once("./models/Visiteur/Visiteur.model.php");
require_once("./controllers/Securite.class.php");

class VisiteurController extends MainController{
    private $visiteurManager;
    private $boutiqueManager;

    public function __construct(){
        $this->visiteurManager = new VisiteurManager();
        $this->boutiqueManager = new boutiqueManager();

    }
  
    public function accueil()
    {
        $article = $this->boutiqueManager->getAticles();
        foreach ($article as $Article) {
            $taille = $this->boutiqueManager->showAticlesByTaille($Article['nom'], $Article['couleurID']);
            $tailleArray[] = $taille;
            
            $couleur = $this->boutiqueManager->showAticlesByCouleur($Article['nom']);
            $couleurArray[] = $couleur;
        }

        $data_page = [
            "page_description" => "Page de boutique",
            "page_title" => "Page de boutique",
            "article" => $article,
            "taille" => $tailleArray,
            "couleur" => $couleurArray,
            "view" => "views/Visiteur/accueil.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function login(){
        $data_page = [
            "page_description" => "Page de connexion",
            "page_title" => "Page de connexion",
            "view" => "views/Visiteur/login.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function creerCompte(){
        $data_page = [
            "page_description" => "Page de création de compte",
            "page_title" => "Page de création de compte",
            "view" => "views/Visiteur/creerCompte.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function pageErreur($msg){
        parent::pageErreur($msg);
    }
}