<?php
require_once("./models/MainManager.model.php");

class UtilisateurManager extends MainManager
{


    private function getPasswordUser($mail)
    {
        $req = "SELECT password FROM utilisateur WHERE mail = :mail";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat['password'];
    }

    public function isCombinaisonValide($mail, $password)
    {
        $passwordBD = $this->getPasswordUser($mail);
        return password_verify($password, $passwordBD);
    }

    public function estCompteActive($mail)
    {
        $req = "SELECT est_valide FROM utilisateur WHERE mail = :mail";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return ((int)$resultat['est_valide'] === 1) ? true : false;
    }

    public function getUserInformation($mail)
    {
        $req = "SELECT * FROM utilisateur WHERE mail = :mail";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }

    public function getLivraisonInformation()
    {
        $req = "SELECT 
        colissimo.id as Cid, colissimo.code_postal as Ccode_postal, colissimo.ville as Cville, colissimo.adresse as Cadresse, colissimo.lieu_dit_bp as Clieu_dit, colissimo.batiment_immeuble as Cbatiment_immeuble, colissimo.appartement_etage as Cappartement_etage, colissimo.defaut as Cdefaut,
        mondial_relay.id as MRid, mondial_relay.nom_enseigne as MRnom_enseigne, mondial_relay.code_postal as MRcode_postal, mondial_relay.ville as MRville, mondial_relay.adresse as MRadresse, mondial_relay.defaut as MRdefaut
        FROM `utilisateur`
                LEFT JOIN mondial_relay ON mondial_relay.id = utilisateur.id_mondial_relay  
                LEFT JOIN colissimo ON colissimo.id = utilisateur.id_colissimo
                WHERE utilisateur.id = :id";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $_SESSION['profil']['id'], PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }

    public function adresseMondialRelay($enseigne, $adresse, $cp, $ville)
    {
        $req = "UPDATE mondial_relay 
        SET nom_enseigne = :enseigne, 
        code_postal = :cp, 
        ville = :ville, 
        adresse = :adresse, 
        defaut='1'
        WHERE id = :id";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $_SESSION['profil']['id'], PDO::PARAM_INT);
        $stmt->bindValue(":enseigne", $enseigne, PDO::PARAM_STR);
        $stmt->bindValue(":adresse", $adresse, PDO::PARAM_STR);
        $stmt->bindValue(":cp", $cp, PDO::PARAM_INT);
        $stmt->bindValue(":ville", $ville, PDO::PARAM_STR);

        $stmt->execute();
        $datas = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $datas;
    }

    public function setDefaultMondialRelay()
    {
        $req = "UPDATE colissimo SET defaut='0' WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $_SESSION['profil']['id'], PDO::PARAM_INT);
        $stmt->execute();
        $datas = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $datas;
    }

    public function adresseColissimo($zipcode, $ville, $adresse, $lieu, $batiment, $appartement)
    {
        $req = "UPDATE colissimo 
        SET
        code_postal = :zipcode, 
        ville = :ville, 
        adresse = :adresse, 
        lieu_dit_bp = :lieu,
        batiment_immeuble = :batiment,
        appartement_etage = :appartement,
        defaut='1'
        WHERE id = :id";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $_SESSION['profil']['id'], PDO::PARAM_INT);
        $stmt->bindValue(":zipcode", $zipcode, PDO::PARAM_INT);
        $stmt->bindValue(":ville", $ville, PDO::PARAM_STR);
        $stmt->bindValue(":adresse", $adresse, PDO::PARAM_STR);
        $stmt->bindValue(":lieu", $lieu, PDO::PARAM_STR);
        $stmt->bindValue(":batiment", $batiment, PDO::PARAM_STR);
        $stmt->bindValue(":appartement", $appartement, PDO::PARAM_STR);

        $stmt->execute();
        $datas = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $datas;
    }

    public function setDefaultColissimo()
    {
        $req = "UPDATE mondial_relay SET defaut='0' WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $_SESSION['profil']['id'], PDO::PARAM_INT);
        $stmt->execute();
        $datas = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $datas;
    }


    



    /* GOOD */
    public function bdCreerCompte($nom, $prenom, $telephone, $mail, $passwordCrypte, $clef)
    {
        $req = "INSERT INTO utilisateur (nom, prenom, mail, telephone, password, est_valide, clef)
        VALUES (:nom, :prenom, :mail, :telephone, :password,  1, :clef)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":nom", $nom, PDO::PARAM_STR);
        $stmt->bindValue(":prenom", $prenom, PDO::PARAM_STR);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->bindValue(":telephone", $telephone, PDO::PARAM_INT);
        $stmt->bindValue(":password", $passwordCrypte, PDO::PARAM_STR);
        $stmt->bindValue(":clef", $clef, PDO::PARAM_INT);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }


    /*modif*/
    public function bdSetIdCompte($mail)
    {
        $utilisateur = $this->getUserInformation($mail);
        $req = "UPDATE utilisateur SET id_colissimo = :id, id_mondial_relay = :id, id_panier = :id WHERE mail = :mail";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->bindValue(":id", $utilisateur['id'], PDO::PARAM_STR);
        $stmt->execute();
        $resultat = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $resultat;
    }
    public function bdCreerLivraison($mail)
    {
        $utilisateur = $this->getUserInformation($mail);
        $req = "INSERT INTO mondial_relay (id) VALUES (:id); INSERT INTO colissimo (id) VALUES (:id)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->bindValue(":id", $utilisateur['id'], PDO::PARAM_STR);
        $stmt->execute();
        $resultat = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $resultat;
    }



    /* GOOD */
    public function verifLoginDisponible($mail)
    {
        $utilisateur = $this->getUserInformation($mail);
        return empty($utilisateur);
    }

    public function bdValidationMailCompte($mail, $clef)
    {
        $req = "UPDATE utilisateur set est_valide = 1 WHERE mail = :mail and clef = :clef";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->bindValue(":clef", $clef, PDO::PARAM_INT);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    /* req modif nom prenom */
    public function bdModificationPrenomUser($mail, $prenom, $nom)
    {
        $req = "UPDATE utilisateur set prenom = :prenom, nom = :nom WHERE mail = :mail";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":prenom", $prenom, PDO::PARAM_STR);
        $stmt->bindValue(":nom", $nom, PDO::PARAM_STR);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    /* req modif telephone */
    public function bdModificationTelephoneUser($mail, $telephone)
    {
        $req = "UPDATE utilisateur set telephone = :telephone WHERE mail = :mail";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":telephone", $telephone, PDO::PARAM_INT);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function bdModificationMailUser($mail, $nouveaumail)
    {
        $req = "UPDATE utilisateur set mail = :nouveaumail WHERE mail = :mail";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->bindValue(":nouveaumail", $nouveaumail, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function bdModificationPassword($mail, $password)
    {
        $req = "UPDATE utilisateur set password = :password WHERE mail = :mail";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function bdSuppressionCompte($mail)
    {
        $req = "DELETE FROM utilisateur WHERE mail = :mail";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }
}
