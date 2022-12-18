<?php
session_start();

define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://" . $_SERVER['HTTP_HOST'] . $_SERVER["PHP_SELF"]));

require_once("./controllers/Toolbox.class.php");
require_once("./controllers/Securite.class.php");
require_once("./controllers/Visiteur/Visiteur.controller.php");
require_once("./controllers/Utilisateur/Utilisateur.controller.php");
require_once("./controllers/Utilisateur/Boutique.controller.php");
require_once("./controllers/Administrateur/Administrateur.controller.php");
$visiteurController = new VisiteurController();
$utilisateurController = new UtilisateurController();
$boutiqueController = new BoutiqueController();
$administrateurController = new AdministrateurController();

try {
    if (empty($_GET['page'])) {
        $page = "accueil";
    } else {
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
        $page = $url[0];
    }

    switch ($page) {

            #region BOUTIQUE
        case "boutique":
            if (!Securite::estConnecte()) {
                Toolbox::ajouterMessageAlerte("Veuillez vous connecter !", Toolbox::COULEUR_ROUGE);
                header("Location: " . URL . "Login");
            } else {
                switch ($url[1]) {

                        /* afficher les articles */
                    case "accueil":
                        $boutiqueController->boutique();
                        break;
                    case "filtreTaille":
                        $_SESSION['filtre']["taille"] = ($_POST['taille']) ? Securite::secureHTML($_POST['taille']) : 0;
                        header('Location: ' . URL . "boutique/accueil");
                        break;
                    case "filtreCouleur":
                        $_SESSION['filtre']["couleur"]  = ($_POST['couleur']) ? Securite::secureHTML($_POST['couleur']) : 0;
                        header('Location: ' . URL . "boutique/accueil");
                        break;
                    case "filtreCategorie":
                        $_SESSION['filtre']["categorie"]  = ($_POST['categorie']) ?  Securite::secureHTML($_POST['categorie']) : 0;
                        header('Location: ' . URL . "boutique/accueil");
                        break;
                    case "filtreCancel":
                        $_SESSION['filtre']["taille"] = 0;
                        $_SESSION['filtre']["couleur"] = 0;
                        $_SESSION['filtre']["categorie"] = 0;
                        $boutiqueController->boutique();
                        break;



                        /* afficher un article */
                    case "article":
                        $articleID = Securite::secureHTML($_POST['articleID']);
                        $articleNOM = Securite::secureHTML($_POST['articleNOM']);
                        $couleurID = Securite::secureHTML($_POST['couleurID']);
                        $boutiqueController->article($articleID, $articleNOM, $couleurID);
                        break;
                        /* ajout d'un article dans le panier */
                    case "articlepanier":
                        $articleID = Securite::secureHTML($_POST['articleID']);
                        $panierID = Securite::secureHTML($_SESSION['profil']["panier"]);
                        $boutiqueController->addArticleToPanier($articleID, $panierID);

                        break;
                        /* afficher le panier */
                    case "panier":
                        $panierID = Securite::secureHTML($_SESSION['profil']["panier"]);

                        $boutiqueController->panier($panierID);
                        break;
                        /* supprimer un article du panier */
                    case "supprimerArticle":
                        $articleID = Securite::secureHTML($_POST['articleID']);
                        $panierID = Securite::secureHTML($_SESSION['profil']["panier"]);
                        $boutiqueController->supprimerArticle($articleID, $panierID);
                        break;
                    case "commande":
                        $panierID = Securite::secureHTML($_SESSION['profil']["panier"]);
                        $boutiqueController->passerCommande($panierID);
                        break;
                    case "checkout-session":
                        $boutiqueController->checkoutSession();
                        break;
                    case "succesPaiement":
                        $boutiqueController->succesPaiement();
                        break;

                    default:
                        throw new Exception("La page n'existe pas");
                }
            }
            break;
            #endregion

            #region VISITEUR
        case "accueil":
            $visiteurController->accueil();
            break;

        case "login":
            $visiteurController->login();
            $_SESSION['filtre']["taille"] = 0;
            $_SESSION['filtre']["couleur"] = 0;
            $_SESSION['filtre']["categorie"] = 0;
            break;
        case "validation_login":
            if (!empty($_POST['mail']) && !empty($_POST['password'])) {
                $mail = Securite::secureHTML($_POST['mail']);
                $password = Securite::secureHTML($_POST['password']);
                $utilisateurController->validation_login($mail, $password);
            } else {
                Toolbox::ajouterMessageAlerte("Mail ou mot de passe non renseigné", Toolbox::COULEUR_ROUGE);
                header('Location: ' . URL . "login");
            }
            break;
        case "creerCompte":
            $visiteurController->creerCompte();
            break;
        case "validation_creerCompte":
            if (!empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['mail']) && !empty($_POST['telephone']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])) {
                $prenom = Securite::secureHTML($_POST['prenom']);
                $nom = Securite::secureHTML($_POST['nom']);
                $mail = Securite::secureHTML($_POST['mail']);
                $telephone = Securite::secureHTML($_POST['telephone']);
                $password = Securite::secureHTML($_POST['password']);
                $confirm_password = Securite::secureHTML($_POST['confirm_password']);
                $utilisateurController->validation_creerCompte($prenom, $nom, $mail, $telephone, $password);
            } else {
                Toolbox::ajouterMessageAlerte("Les 3 informations sont obligatoires !", Toolbox::COULEUR_ROUGE);
                header("Location: " . URL . "creerCompte");
            }
            break;
        case "renvoyerMailValidation":
            $utilisateurController->renvoyerMailValidation($url[1]);
            break;
            /*         case "validationMail":
            $utilisateurController->validation_mailCompte($url[1], $url[2]);
            break; */

            #endregion

            #region UTILISATEUR

        case "compte":
            if (!Securite::estConnecte()) {
                Toolbox::ajouterMessageAlerte("Veuillez vous connecter !", Toolbox::COULEUR_ROUGE);
                header("Location: " . URL . "login");
            } elseif (!Securite::checkCookieConnexion()) {
                Toolbox::ajouterMessageAlerte("Veuillez vous reconnecter !", Toolbox::COULEUR_ROUGE);
                setcookie(Securite::COOKIE_NAME, "", time() - 3600);
                unset($_SESSION["profil"]);
                header("Location: " . URL . "login");
            } else {
                Securite::genererCookieConnexion(); //regénération du cookie
                switch ($url[1]) {

                    case "profil":
                        $utilisateurController->profil();
                        break;
                    case "gestion":
                        $utilisateurController->gestion();
                        break;
                    case "livraison":
                        $utilisateurController->livraison();
                        break;
                    case "accueil":
                        $ftaille = (!Securite::secureHTML($_POST['taille'])) ? 0 : Securite::secureHTML($_POST['taille']);
                        $fcouleur  = (!Securite::secureHTML($_POST['couleur'])) ? 0 : Securite::secureHTML($_POST['couleur']);
                        $fcategorie  = (!Securite::secureHTML($_POST['categorie'])) ? 0 : Securite::secureHTML($_POST['categorie']);
                        $boutiqueController->boutique();
                        break;
                    case "deconnexion":
                        $utilisateurController->deconnexion();
                        unset($_SESSION["filtre"]);
                        break;
                    case "validation_modificationMail":
                        $utilisateurController->validation_modificationMail(Securite::secureHTML($_POST['mail']));
                        break;
                    case "validation_modificationPrenom":
                        $utilisateurController->validation_modificationPrenom(Securite::secureHTML($_POST['prenom']), Securite::secureHTML($_POST['nom']));
                        break;
                    case "validation_modificationTelephone":
                        $utilisateurController->validation_modificationTelephone(Securite::secureHTML($_POST['telephone']));
                        break;
                    case "adresseMondialRelay":
                        $enseigne = Securite::secureHTML($_POST['enseigne']);
                        $adresse = Securite::secureHTML($_POST['adresse']);
                        $cp = Securite::secureHTML($_POST['cp']);
                        $ville = Securite::secureHTML($_POST['ville']);
                        $utilisateurController->adresseMondialRelay($enseigne, $adresse, $cp, $ville);
                        break;
                    case "adresseColissimo":
                        $adresse = Securite::secureHTML($_POST['adresse']);
                        $cp = Securite::secureHTML($_POST['zipcode']);
                        $ville = Securite::secureHTML($_POST['city']);
                        $lieu = Securite::secureHTML($_POST['lieu']);
                        $batiment = Securite::secureHTML($_POST['batiment']);
                        $appartement = Securite::secureHTML($_POST['appartement']);
                        $utilisateurController->adresseColissimo($cp, $ville, $adresse, $lieu, $batiment, $appartement);
                        break;
                        /* case "validation_modificationPassword":
                        if (!empty($_POST['ancienPassword']) && !empty($_POST['nouveauPassword']) && !empty($_POST['confirmNouveauPassword'])) {
                            $ancienPassword = Securite::secureHTML($_POST['ancienPassword']);
                            $nouveauPassword = Securite::secureHTML($_POST['nouveauPassword']);
                            $confirmationNouveauPassword = Securite::secureHTML($_POST['confirmNouveauPassword']);
                            $utilisateurController->validation_modificationPassword($ancienPassword, $nouveauPassword, $confirmationNouveauPassword);
                        } else {
                            Toolbox::ajouterMessageAlerte("Vous n'avez pas renseigné toutes les informations", Toolbox::COULEUR_ROUGE);
                            header("Location: " . URL . "compte/modificationPassword");
                        }
                        break; */
                    case "suppressionCompte":
                        $utilisateurController->suppressionCompte();
                        break;

                    default:
                        throw new Exception("La page n'existe pas");
                }
            }
            break;
            #endregion

            #region ADMINISTRATION
        case "administration":
            if (!Securite::estConnecte()) {
                Toolbox::ajouterMessageAlerte("Veuillez vous connecter !", Toolbox::COULEUR_ROUGE);
                header("Location: " . URL . "Login");
            } elseif (!Securite::estAdministrateur()) {
                Toolbox::ajouterMessageAlerte("Vous n'avez le droit d'être ici", Toolbox::COULEUR_ROUGE);
                header("Location: " . URL . "accueil");
            } else {
                switch ($url[1]) {
                    case "formulaireAjoutArticle":
                        $administrateurController->ajoutArticle();
                        break;
                    case "ajouterArticle":
                        $nom = Securite::secureHTML($_POST['nom']);
                        $prix = Securite::secureHTML($_POST['prix']);
                        $promotion = Securite::secureHTML($_POST['promotion']);
                        $idCategorie = Securite::secureHTML($_POST['idCategorie']);
                        $idCouleur = Securite::secureHTML($_POST['idCouleur']);
                        $idTaille = Securite::secureHTML($_POST['idTaille']);
                        $image = $_FILES['image'];
                        $administrateurController->validationAjoutArticle($nom, $prix, $promotion, $idCategorie, $idCouleur, $idTaille, $image);
                        break;



                    case "articles":
                        $administrateurController->viewArticles();
                        break;
                    case "modifier_un_article":
                        $articleID = Securite::secureHTML($_POST['articleID']);
                        $administrateurController->modifArticle($articleID);
                        break;
                    case "validation_modifier_un_article":
                        $articleID = Securite::secureHTML($_POST['id']);
                        $nom = Securite::secureHTML($_POST['nom']);
                        $prix = Securite::secureHTML($_POST['prix']);
                        $promotion = Securite::secureHTML($_POST['promotion']);
                        $idCategorie = Securite::secureHTML($_POST['idCategorie']);
                        $idCouleur = Securite::secureHTML($_POST['idCouleur']);
                        $idTaille = Securite::secureHTML($_POST['idTaille']);
                        $administrateurController->validationModifArticle($articleID, $nom, $prix, $promotion, $idCategorie, $idCouleur, $idTaille);
                        break;
                    case "cacher_un_article":
                        $id = Securite::secureHTML($_POST['id']);
                        $administrateurController->hideArticle($id);
                        break;
                    case "supprimer_un_article":
                        $id = Securite::secureHTML($_POST['id']);
                        $administrateurController->deleteArticle($id);
                        break;
                    default:
                        throw new Exception("La page n'existe pas");
                }
            }
            break;
            #endregion

        default:
            throw new Exception("La page n'existe pas");
    }
} catch (Exception $e) {
    $visiteurController->pageErreur($e->getMessage());
}
