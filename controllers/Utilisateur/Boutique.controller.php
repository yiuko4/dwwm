<?php
require_once("./controllers/MainController.controller.php");
require_once("./models/Utilisateur/Boutique.model.php");

class BoutiqueController extends MainController
{
    private $boutiqueManager;

    public function __construct()
    {
        $this->boutiqueManager = new BoutiqueManager();
    }

    /* Affiche page accueil */
    public function boutique()
    {
        $ftaille = $_SESSION['filtre']["taille"]; 
        $fcouleur = $_SESSION['filtre']["couleur"];
        $fcategorie = $_SESSION['filtre']["categorie"];

        if ($ftaille != 0 && $fcouleur != 0 && $fcategorie != 0)/* taille couleur categorie */ {
            $article = $this->boutiqueManager->getAticlesTailleCouleurCategorie($ftaille, $fcouleur, $fcategorie);
        } elseif ($ftaille != 0 && $fcouleur != 0) /* taille couleur */ {
            $article = $this->boutiqueManager->getAticlesTailleCouleur($ftaille, $fcouleur);
        } elseif ($ftaille != 0 && $fcategorie != 0) {
            $article = $this->boutiqueManager->getAticlesTailleCategorie($ftaille, $fcategorie);
        } elseif ($fcouleur != 0 && $fcategorie != 0) {
            $article = $this->boutiqueManager->getAticlesCouleurCategorie($fcouleur, $fcategorie);
        } elseif ($ftaille != 0) /* taille */ {
            $article = $this->boutiqueManager->getAticlesTaille($ftaille);
        } elseif ($fcouleur != 0) /* couleur */ {
            $article = $this->boutiqueManager->getAticlesCouleur($fcouleur);
        } elseif ($fcategorie != 0) {
            $article = $this->boutiqueManager->getAticlesCategorie($fcategorie);
        } else
            $article = $this->boutiqueManager->getAticles();

        $tailleArray = array();
        $couleurArray = array();

        if (!empty($article)) {
            /* affiche les tailles associées à l'article */
            $tailleArray = $this->taille($article);
            /* affiche les couleurs associées à l'article */
            $couleurArray = $this->couleur($article);
        }
        
        /* affiche toutes les tailles */
        $filtreTaille = $this->boutiqueManager->allTaille();
        $filtreCouleur = $this->boutiqueManager->allCouleur();
        $filtreCategorie = $this->boutiqueManager->allCategorie();

        $data_page = [
            "page_description" => "Page de boutique",
            "page_title" => "Page de boutique",
            "article" => $article,
            "taille" => $tailleArray,
            "couleur" => $couleurArray,

            "filtreTaille" => $filtreTaille,
            "filtreCouleur" => $filtreCouleur,
            "filtreCategorie" => $filtreCategorie,
            "view" => "views/Utilisateur/boutique.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }



    public function taille($article)
    {
        foreach ($article as $Article) {
            $taille = $this->boutiqueManager->showAticlesByTaille($Article['nom'], $Article['couleurID']);
            $tailleArray[] = $taille;
        }
        return $tailleArray;
    }

    public function couleur($article)
    {
        foreach ($article as $Article) {
            $couleur = $this->boutiqueManager->showAticlesByCouleur($Article['nom']);
            $couleurArray[] = $couleur;
        }
        return $couleurArray;
    }

    /* Affiche page article */
    public function article($articleID, $articleNOM, $couleurID)
    {
        $article = $this->boutiqueManager->showAticles($articleID);
        $taille = $this->boutiqueManager->showAticlesByTaille($articleNOM, $couleurID);
        $couleur = $this->boutiqueManager->showAticlesByCouleur($articleNOM);

        $data_page = [
            "page_description" => "Page d'article'",
            "page_title" => "Page d'article",
            "article" => $article,
            "taille" => $taille,
            "couleur" => $couleur,
            "view" => "views/Utilisateur/article.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    /* Ajout article panier */
    public function addArticleToPanier($articleID, $panierID)
    {
        if (!$this->boutiqueManager->isPanier($articleID, $panierID)) {
            $this->boutiqueManager->addArticleToPanier($articleID, $_SESSION['profil']["panier"]);
            Toolbox::ajouterMessageAlerte("L'article a été ajouter au panier", Toolbox::COULEUR_VERTE);
        } else {
            Toolbox::ajouterMessageAlerte("L'article est déja dans votre panier", Toolbox::COULEUR_ROUGE);
        }
        header("Location: " . URL . "boutique/accueil");
    }

    /* Affiche page panier */
    public function panier($panierID)
    {
        $panier = $this->boutiqueManager->panier($panierID);
        $data_page = [
            "page_description" => "Page du panier",
            "page_title" => "Page du panier",
            "panier" => $panier,
            "view" => "views/Utilisateur/panier.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    /* Supprime article panier */
    public function supprimerArticle($articleID, $panierID)
    {
        if ($this->boutiqueManager->supprimerArticle($articleID, $panierID)) {
            Toolbox::ajouterMessageAlerte("L'article a été  supprimé", Toolbox::COULEUR_VERTE);
        } else {
            Toolbox::ajouterMessageAlerte("L'article n'a été supprimé", Toolbox::COULEUR_ROUGE);
        }
        header("Location: " . URL . "boutique/panier");
    }

    public function passerCommande($panierID)
    {
        $livraison = $this->boutiqueManager->livraison();
        $panier = $this->boutiqueManager->panier($panierID);

        $data_page = [
            "page_description" => "Page de commande",
            "page_title" => "Page de commande",
            "utilisateur" => $livraison,
            "panier" => $panier,
            "page_javascript" => ['https://js.stripe.com/v3/'],
            "view" => "views/Utilisateur/commande.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function checkoutSession()
    {
        $create_checkout = $this->boutiqueManager->panier($_SESSION['profil']["panier"]);
        $data_page = [
            "page_description" => "create checkout session",
            "page_title" => "create checkout session",
            "create_checkout" => $create_checkout,
            "view" => "views/Utilisateur/checkout-session.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function succesPaiement()
    {
        $data_page = [
            "page_description" => "Succes paiement",
            "page_title" => "succes paiement",
            "view" => "views/Utilisateur/succesPaiement.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    



    public function pageErreur($msg)
    {
        parent::pageErreur($msg);
    }
}
