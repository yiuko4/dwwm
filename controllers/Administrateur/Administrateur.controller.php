<?php
require_once("./controllers/MainController.controller.php");
require_once("./models/Administrateur/Administrateur.model.php");

class AdministrateurController extends MainController
{
    private $administrateurManager;

    public function __construct()
    {
        $this->administrateurManager = new AdministrateurManager();
    }

    public function ajoutArticle() /**/
    {
        $data_page = [
            "page_description" => "Page d'ajout article",
            "page_title" => "Page d'ajout article",
            "page_javascript" => ['profil.js'],
            "view" => "views/Administrateur/ajoutArticle.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }


    public function validationAjoutArticle($nom, $prix, $promotion, $idCategorie, $idCouleur, $idTaille, $file)
    {
        $repertoire = "public/Assets/images/article/";
        /* Toolbox::ajoutImage($file, $repertoire); */
        $nomImage = Toolbox::ajoutImage($file, $repertoire);
        /* $nomImage = "test"; */
        $this->administrateurManager->infoAjoutArticle($nom, $nomImage, $prix, $promotion, $idCategorie, $idCouleur, $idTaille);
        header("Location: " . URL . "administration/articles");
    }


     public function validationModifArticle($articleID, $nom, $prix, $promotion, $idCategorie, $idCouleur, $idTaille)
    {
        if ($this->administrateurManager->infoModifArticle($articleID, $nom, $prix, $promotion, $idCategorie, $idCouleur, $idTaille)) {
            Toolbox::ajouterMessageAlerte("marche", Toolbox::COULEUR_VERTE);
        } else {
            Toolbox::ajouterMessageAlerte("marche pas", Toolbox::COULEUR_ROUGE);
        }
        header("Location: " . URL . "administration/articles");
    } 


    public function viewArticles()
    {
        $viewArticles = $this->administrateurManager->viewArticles();

        $data_page = [
            "page_description" => "Gestion des droits",
            "page_title" => "Gestion des droits",
            "viewArticles" => $viewArticles,
            "view" => "views/Administrateur/viewArticles.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }


    public function modifArticle($articleID)
    {
        $modifArticle = $this->administrateurManager->modifArticle($articleID);

        $data_page = [
            "page_description" => "Modifier un article",
            "page_title" => "Modifier un article",
            "modifArticle" => $modifArticle,
            "view" => "views/Administrateur/modifArticles.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }


    public function hideArticle($id)
    {
        if ($this->administrateurManager->unHideArticle($id)) {
            Toolbox::ajouterMessageAlerte("L'article a été affiché", Toolbox::COULEUR_VERTE);
        } elseif ($this->administrateurManager->hideArticle($id)) {
            Toolbox::ajouterMessageAlerte("L'article a été caché", Toolbox::COULEUR_VERTE);
        } else {
            Toolbox::ajouterMessageAlerte("L'article n'a pas été caché", Toolbox::COULEUR_ROUGE);
        }

        header("Location: " . URL . "administration/articles");
    }

    
    public function deleteArticle($id)
    {
        if ($this->administrateurManager->deleteArticle($id)) {
            Toolbox::ajouterMessageAlerte("L'article a été supprimé", Toolbox::COULEUR_VERTE);
        } else {
            Toolbox::ajouterMessageAlerte("L'article n'a pas été supprimé", Toolbox::COULEUR_ROUGE);
        }
        header("Location: " . URL . "administration/articles");
    }



    /*     public function droits(){
        $utilisateurs = $this->administrateurManager->getUtilisateurs();

        $data_page = [
            "page_description" => "Gestion des droits", 
            "page_title" => "Gestion des droits",
            "utilisateurs" => $utilisateurs,
            "view" => "views/Administrateur/droits.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    } */

    /* public function validation_modificationRole($login, $role)
    {
        if ($this->administrateurManager->bdModificationRoleUser($login, $role)) {
            Toolbox::ajouterMessageAlerte("La modification a été prise en compte", Toolbox::COULEUR_VERTE);
        } else {
            Toolbox::ajouterMessageAlerte("La modification n'a pas été prise en compte", Toolbox::COULEUR_ROUGE);
        }
        header("Location: " . URL . "administration/droits");
    } */

    public function pageErreur($msg)
    {
        parent::pageErreur($msg);
    }
}
