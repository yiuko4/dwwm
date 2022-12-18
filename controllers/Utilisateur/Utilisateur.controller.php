<?php
require_once("./controllers/MainController.controller.php");
require_once("./models/Utilisateur/Utilisateur.model.php");

class UtilisateurController extends MainController
{
    private $utilisateurManager;

    public function __construct()
    {
        $this->utilisateurManager = new UtilisateurManager();
    }

   

    public function validation_login($mail, $password)
    {
        if ($this->utilisateurManager->isCombinaisonValide($mail, $password)) {
            if ($this->utilisateurManager->estCompteActive($mail)) {
                Toolbox::ajouterMessageAlerte("Bon retour sur le site " . $mail . " !", Toolbox::COULEUR_VERTE);
                $_SESSION['profil'] = [
                    "mail" => $mail,
                ];
                Securite::genererCookieConnexion();
                echo $_SESSION['profil'][Securite::COOKIE_NAME];
                echo "<br />";
                echo $_COOKIE[Securite::COOKIE_NAME];

                header("location: " . URL . "compte/profil");
            } else {
                $msg = "Le compte " . $mail . " n'a pas été activé par mail. ";
                $msg .= "<a href='renvoyerMailValidation/" . $mail . "'>Renvoyez le mail de validation</a>";
                Toolbox::ajouterMessageAlerte($msg, Toolbox::COULEUR_ROUGE);
                header("Location: " . URL . "login");
            }
        } else {
            Toolbox::ajouterMessageAlerte("Combinaison Mail / Mot de passe non valide", Toolbox::COULEUR_ROUGE);
            header("Location: " . URL . "login");
        }
    }
    public function profil()
    {
        $datas = $this->utilisateurManager->getUserInformation($_SESSION['profil']['mail']);
        $_SESSION['profil']["role"] = $datas['role'];
        $_SESSION['profil']["panier"] = $datas['id_panier'];
        $_SESSION['profil']["id"] = $datas['id'];


        $data_page = [
            "page_description" => "Page de profil",
            "page_title" => "Page de profil",
            "utilisateur" => $datas,
            "page_javascript" => ['profil.js'],
            "view" => "views/Utilisateur/profil.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function livraison()
    {
        $datas = $this->utilisateurManager->getLivraisonInformation();

        $data_page = [
            "page_description" => "Page de livraison",
            "page_title" => "Page de livraison",
            "livraison" => $datas,
            "page_javascript" => ['profil.js'],
            "view" => "views/Utilisateur/livraison.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function adresseMondialRelay($enseigne, $adresse, $cp, $ville)
    {
        if ($this->utilisateurManager->adresseMondialRelay($enseigne, $adresse, $cp, $ville)) {
            $this->utilisateurManager->setDefaultMondialRelay();
            Toolbox::ajouterMessageAlerte("L'adresse mondial relay a été modifié", Toolbox::COULEUR_VERTE);
        } else {
            Toolbox::ajouterMessageAlerte("Aucune modification effectuée", Toolbox::COULEUR_ROUGE);
        }
        header("Location: " . URL . "compte/livraison");
    }

    public function adresseColissimo($zipcode, $ville, $adresse, $lieu, $batiment, $appartement)
    {
        if ($this->utilisateurManager->adresseColissimo($zipcode, $ville, $adresse, $lieu, $batiment, $appartement)) {
            $this->utilisateurManager->setDefaultColissimo();
            Toolbox::ajouterMessageAlerte("L'adresse mondial relay a été modifié", Toolbox::COULEUR_VERTE);
        } else {
            Toolbox::ajouterMessageAlerte("Aucune modification effectuée", Toolbox::COULEUR_ROUGE);
        }
        header("Location: " . URL . "compte/livraison");
    }


    public function deconnexion()
    {
        Toolbox::ajouterMessageAlerte("La deconnexion est effectuée", Toolbox::COULEUR_VERTE);
        unset($_SESSION['profil']);
        setcookie(Securite::COOKIE_NAME, "", time() - 3600);
        header("Location: " . URL . "accueil");
    }
    /* GOOD */
    public function validation_creerCompte($nom, $prenom, $mail, $telephone, $password)
    {
        if ($this->utilisateurManager->verifLoginDisponible($mail)) {
            $passwordCrypte = password_hash($password, PASSWORD_DEFAULT);
            $clef = rand(0, 9999);
            if ($this->utilisateurManager->bdCreerCompte($nom, $prenom, $telephone, $mail, $passwordCrypte, $clef)) {
                $this->utilisateurManager->bdSetIdCompte($mail);
                $this->utilisateurManager->bdCreerLivraison($mail);
                $this->sendMailValidation($mail, $clef);
                Toolbox::ajouterMessageAlerte("La compte a été créé, Un mail de validation vous a été envoyé !", Toolbox::COULEUR_VERTE);
                header("Location: " . URL . "login");
            } else {
                Toolbox::ajouterMessageAlerte("Erreur lors de la création du compte, recommencez !", Toolbox::COULEUR_ROUGE);
                header("Location: " . URL . "creerCompte");
            }
        } else {
            Toolbox::ajouterMessageAlerte("Cette adresse mail est déjà utilisé !", Toolbox::COULEUR_ROUGE);
            header("Location: " . URL . "creerCompte");
        }
    }

    /* pas testé */
    
    private function sendMailValidation($mail, $clef)
    {
        $urlVerification = URL . "validationMail" . $clef;
        $sujet = "Création du compte sur le site Flo & les tortues";
        $message = "Pour valider votre compte veuillez cliquer sur le lien suivant " . $urlVerification;
        Toolbox::sendMail($mail, $sujet, $message);
    }

    /* pas testé */
    public function renvoyerMailValidation($mail)
    {
        $utilisateur = $this->utilisateurManager->getUserInformation($mail);
        $this->sendMailValidation($utilisateur['mail'], $utilisateur['clef']);
        header("Location: " . URL . "login");
    }
    /* pas testé */
    /*     public function validation_mailCompte($mail, $clef)
    {
        if ($this->utilisateurManager->bdValidationMailCompte($clef)) {
            Toolbox::ajouterMessageAlerte("Le compte a été activé !", Toolbox::COULEUR_VERTE);
            $_SESSION['profil'] = [
                "mail" => $mail,
            ];
            header('Location: ' . URL . 'compte/profil');
        } else {
            Toolbox::ajouterMessageAlerte("Le compte n'a pas été activé !", Toolbox::COULEUR_ROUGE);
            header('Location: ' . URL . 'creerCompte');
        }
    } */







    public function validation_modificationPrenom($prenom, $nom)
    {
        if ($this->utilisateurManager->bdModificationPrenomUser($_SESSION['profil']['mail'], $prenom, $nom)) {
            Toolbox::ajouterMessageAlerte("La modification est effectuée", Toolbox::COULEUR_VERTE);
        } else {
            Toolbox::ajouterMessageAlerte("Aucune modification effectuée", Toolbox::COULEUR_ROUGE);
        }
        header("Location: " . URL . "compte/profil");
    }

    public function validation_modificationTelephone($telephone)
    {
        if ($this->utilisateurManager->bdModificationTelephoneUser($_SESSION['profil']['mail'], $telephone)) {
            Toolbox::ajouterMessageAlerte("La modification est effectuée", Toolbox::COULEUR_VERTE);
        } else {
            Toolbox::ajouterMessageAlerte("Aucune modification effectuée", Toolbox::COULEUR_ROUGE);
        }
        header("Location: " . URL . "compte/profil");
    }



    public function validation_modificationMail($mail)
    {
        if ($this->utilisateurManager->bdModificationMailUser($_SESSION['profil']['mail'], $mail)) {
            Toolbox::ajouterMessageAlerte("La modification est effectuée", Toolbox::COULEUR_VERTE);
            $_SESSION['profil'] = [
                "mail" => $mail,
            ];
        } else {
            Toolbox::ajouterMessageAlerte("Aucune modification effectuée", Toolbox::COULEUR_ROUGE);
        }
        header("Location: " . URL . "compte/profil");
    }

    /*     public function validation_modificationPassword($password)
    {
        if ($this->utilisateurManager->bdModificationPasswordUser($_SESSION['profil']['password'], $password)) {
            Toolbox::ajouterMessageAlerte("La modification est effectuée", Toolbox::COULEUR_VERTE);
        } else {
            Toolbox::ajouterMessageAlerte("Aucune modification effectuée", Toolbox::COULEUR_ROUGE);
        }
        header("Location: " . URL . "compte/profil");
    } */




    /*     public function modificationPassword()
    {
        $data_page = [
            "page_description" => "Page de modification du password",
            "page_title" => "Page de modification du password",
            "page_javascript" => ["modificationPassword.js"],
            "view" => "views/Utilisateur/modificationPassword.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }
    public function validation_modificationPassword($ancienPassword, $nouveauPassword, $confirmationNouveauPassword)
    {
        if ($nouveauPassword === $confirmationNouveauPassword) {
            if ($this->utilisateurManager->isCombinaisonValide($_SESSION['profil']['login'], $ancienPassword)) {
                $passwordCrypte = password_hash($nouveauPassword, PASSWORD_DEFAULT);
                if ($this->utilisateurManager->bdModificationPassword($_SESSION['profil']['login'], $passwordCrypte)) {
                    Toolbox::ajouterMessageAlerte("La modification du password a été effectuée", Toolbox::COULEUR_VERTE);
                    header("Location: " . URL . "compte/profil");
                } else {
                    Toolbox::ajouterMessageAlerte("La modification a échouée", Toolbox::COULEUR_ROUGE);
                    header("Location: " . URL . "compte/modificationPassword");
                }
            } else {
                Toolbox::ajouterMessageAlerte("La combinaison login / ancien password ne correspond pas", Toolbox::COULEUR_ROUGE);
                header("Location: " . URL . "compte/modificationPassword");
            }
        } else {
            Toolbox::ajouterMessageAlerte("Les passwords ne correspondent pas", Toolbox::COULEUR_ROUGE);
            header("Location: " . URL . "compte/modificationPassword");
        }
    } */

    public function suppressionCompte()
    {

        if ($this->utilisateurManager->bdSuppressionCompte($_SESSION['profil']['mail'])) {
            Toolbox::ajouterMessageAlerte("La suppression du compte est effectuée", Toolbox::COULEUR_VERTE);
            $this->deconnexion();
        } else {
            Toolbox::ajouterMessageAlerte("La suppression n'a pas été effectuée. Contactez l'administrateur", Toolbox::COULEUR_ROUGE);
            header("Location: " . URL . "compte/profil");
        }
    }



    public function pageErreur($msg)
    {
        parent::pageErreur($msg);
    }
}
