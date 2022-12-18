<?php
require_once("./models/MainManager.model.php");

class BoutiqueManager extends MainManager
{

    public function getAticles()
    {
        $req = "SELECT article.id as id, 
        article.nom as nom, 
        article.image as image,
        article.prix as prix,
        article.promotion as promotion,
        taille.nom as taille,
        taille.id as tailleID, 
        couleur.nom as couleur, 
        couleur.id as couleurID
        FROM article
        INNER JOIN taille ON article.id_taille = taille.id  
        INNER JOIN couleur ON article.id_couleur = couleur.id
        WHERE visible = 1
        GROUP BY image
        ORDER BY id ;
        ";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        /* $datas = ($stmt->rowCount() > 0); */
        $stmt->closeCursor();
        return $datas;
    }

    /* affiche un article*/
    public function showAticles($articleID)
    {
        $req = "SELECT article.id as id, 
        article.nom as nom, 
        article.image as image,
        article.prix as prix,
        article.promotion as promotion,
        taille.nom as taille, 
        couleur.nom as couleur, 
        couleur.id as couleurID
        FROM article
        LEFT JOIN taille ON article.id_taille = taille.id  
        LEFT JOIN couleur ON article.id_couleur = couleur.id
        WHERE article.id= :id  AND visible = 1 ;";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $articleID, PDO::PARAM_INT);
        $stmt->execute();
        $datas = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $datas;
    }

    /* affiche la taille des articles */
    public function showAticlesByTaille($articleNOM, $couleurID)
    {
        $req = "SELECT article.id as id, article.nom as nom, taille.nom as taille, couleur.id as couleurID
        FROM article
        LEFT JOIN couleur ON article.id_couleur = couleur.id
        LEFT JOIN taille ON article.id_taille = taille.id
        WHERE article.nom= :nom AND couleur.id= :couleur  AND visible = 1
        GROUP BY taille
        ORDER BY taille.id ASC;
        ";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":nom", $articleNOM, PDO::PARAM_STR);
        $stmt->bindValue(":couleur", $couleurID, PDO::PARAM_INT);

        $stmt->execute();
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $datas;
    }

    /* affiche la couleur des articles */
    public function showAticlesByCouleur($articleNOM)
    {
        $req = "SELECT article.id as id, article.nom as nom, couleur.id as couleurID, couleur.hex as hexadecimal
        FROM article
        LEFT JOIN couleur ON article.id_couleur = couleur.id
        LEFT JOIN taille ON article.id_taille = taille.id
        WHERE article.nom= :nom  AND visible = 1
        GROUP BY couleurID
        ORDER BY couleur.id ASC;";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":nom", $articleNOM, PDO::PARAM_STR);

        $stmt->execute();
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $datas;
    }

    /* l'article est-il dans le panier ? */
    public function isPanier($articleID, $panierID)
    {
        $req = "SELECT * FROM `panier_article` WHERE `id_panier` = :panier AND `id_article` = :article";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":panier", $panierID, PDO::PARAM_INT);
        $stmt->bindValue(":article", $articleID, PDO::PARAM_INT);
        $stmt->execute();
        $datas = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $datas;
    }

    /* ajout d'un article dans le panier */
    public function addArticleToPanier($articleID, $panierID)
    {
        $req = "INSERT INTO panier_article (id, id_panier, id_article) 
        VALUES (NULL, :panier, :article); ";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":panier", $panierID, PDO::PARAM_INT);
        $stmt->bindValue(":article", $articleID, PDO::PARAM_INT);
        $stmt->execute();
        $datas = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $datas;
    }

    public function allTaille()
    {
        $req = "SELECT * FROM taille";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $datas;
    }

    public function getAticlesTaille($filtre)
    {
        $req = "SELECT article.id as id, 
        article.nom as nom, 
        article.image as image,
        article.prix as prix,
        article.promotion as promotion,
        taille.nom as taille,
        taille.id as tailleID, 
        couleur.nom as couleur, 
        couleur.id as couleurID
        FROM article
        INNER JOIN taille ON article.id_taille = taille.id  
        INNER JOIN couleur ON article.id_couleur = couleur.id
        INNER JOIN categorie ON article.id_categorie = categorie.id
        WHERE taille.id = :taille  AND visible = 1
        GROUP BY image
        ORDER BY id ;
        ";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":taille", $filtre, PDO::PARAM_INT);
        $stmt->execute();
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $datas;
    }
    public function getAticlesCategorie($filtre)
    {
        $req = "SELECT article.id as id, 
        article.nom as nom, 
        article.image as image,
        article.prix as prix,
        article.promotion as promotion,
        taille.nom as taille,
        taille.id as tailleID, 
        couleur.nom as couleur, 
        couleur.id as couleurID
        FROM article
        INNER JOIN taille ON article.id_taille = taille.id  
        INNER JOIN couleur ON article.id_couleur = couleur.id
        INNER JOIN categorie ON article.id_categorie = categorie.id
        WHERE categorie.id = :categorie  AND visible = 1
        GROUP BY image
        ORDER BY id ;
        ";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":categorie", $filtre, PDO::PARAM_INT);
        $stmt->execute();
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $datas;
    }

    public function getAticlesCouleur($filtre)
    {
        $req = "SELECT article.id as id, 
        article.nom as nom, 
        article.image as image,
        article.prix as prix,
        article.promotion as promotion,
        taille.nom as taille,
        taille.id as tailleID, 
        couleur.nom as couleur, 
        couleur.id as couleurID
        FROM article
        INNER JOIN taille ON article.id_taille = taille.id  
        INNER JOIN couleur ON article.id_couleur = couleur.id
        INNER JOIN categorie ON article.id_categorie = categorie.id
        WHERE couleur.id = :couleur  AND visible = 1
        GROUP BY image
        ORDER BY id ;
        ";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":couleur", $filtre, PDO::PARAM_INT);
        $stmt->execute();
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $datas;
    }

    public function getAticlesTailleCouleur($ftaille, $fcouleur)
    {
        $req = "SELECT article.id as id, 
        article.nom as nom, 
        article.image as image,
        article.prix as prix,
        article.promotion as promotion,
        taille.nom as taille,
        taille.id as tailleID, 
        couleur.nom as couleur, 
        couleur.id as couleurID
        FROM article
        INNER JOIN taille ON article.id_taille = taille.id  
        INNER JOIN couleur ON article.id_couleur = couleur.id
        INNER JOIN categorie ON article.id_categorie = categorie.id
        WHERE couleur.id = :couleur AND taille.id = :taille  AND visible = 1
        GROUP BY image
        ORDER BY id ;
        ";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":taille", $ftaille, PDO::PARAM_INT);
        $stmt->bindValue(":couleur", $fcouleur, PDO::PARAM_INT);

        $stmt->execute();
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $datas;
    }

    public function getAticlesTailleCategorie($ftaille, $fcategorie)
    {
        $req = "SELECT article.id as id, 
        article.nom as nom, 
        article.image as image,
        article.prix as prix,
        article.promotion as promotion,
        taille.nom as taille,
        taille.id as tailleID, 
        couleur.nom as couleur, 
        couleur.id as couleurID
        FROM article
        INNER JOIN taille ON article.id_taille = taille.id  
        INNER JOIN couleur ON article.id_couleur = couleur.id
        INNER JOIN categorie ON article.id_categorie = categorie.id
        WHERE categorie.id = :categorie AND taille.id = :taille  AND visible = 1
        GROUP BY image
        ORDER BY id ;
        ";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":taille", $ftaille, PDO::PARAM_INT);
        $stmt->bindValue(":categorie", $fcategorie, PDO::PARAM_INT);

        $stmt->execute();
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $datas;
    }

    public function getAticlesCouleurCategorie($fcouleur, $fcategorie)
    {
        $req = "SELECT article.id as id, 
        article.nom as nom, 
        article.image as image,
        article.prix as prix,
        article.promotion as promotion,
        taille.nom as taille,
        taille.id as tailleID, 
        couleur.nom as couleur, 
        couleur.id as couleurID
        FROM article
        INNER JOIN taille ON article.id_taille = taille.id  
        INNER JOIN couleur ON article.id_couleur = couleur.id
        INNER JOIN categorie ON article.id_categorie = categorie.id
        WHERE categorie.id = :categorie AND couleur.id = :couleur  AND visible = 1
        GROUP BY image
        ORDER BY id ;
        ";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":couleur", $fcouleur, PDO::PARAM_INT);
        $stmt->bindValue(":categorie", $fcategorie, PDO::PARAM_INT);

        $stmt->execute();
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $datas;
    }

    public function getAticlesTailleCouleurCategorie($ftaille, $fcouleur, $categorie)
    {
        $req = "SELECT article.id as id, 
        article.nom as nom, 
        article.image as image,
        article.prix as prix,
        article.promotion as promotion,
        taille.nom as taille,
        taille.id as tailleID, 
        couleur.nom as couleur, 
        couleur.id as couleurID
        FROM article
        INNER JOIN taille ON article.id_taille = taille.id  
        INNER JOIN couleur ON article.id_couleur = couleur.id
        INNER JOIN categorie ON article.id_categorie = categorie.id
        WHERE couleur.id = :couleur AND taille.id = :taille AND categorie.id = :categorie AND visible = 1
        GROUP BY image
        ORDER BY id ;
        ";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":taille", $ftaille, PDO::PARAM_INT);
        $stmt->bindValue(":couleur", $fcouleur, PDO::PARAM_INT);
        $stmt->bindValue(":categorie", $categorie, PDO::PARAM_INT);

        $stmt->execute();
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $datas;
    }

    public function allCouleur()
    {
        $req = "SELECT * FROM couleur";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $datas;
    }

    public function allCategorie()
    {
        $req = "SELECT * FROM categorie";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $datas;
    }
    #endregion

    #region PANIER
    /* affiche le panier */
    public function panier($panierID)
    {
        $req = "SELECT article.id as id, 
        article.nom as nom, 
        article.image as image,
        article.prix as prix,
        article.promotion as promotion,
        taille.nom as taille, 
        couleur.nom as couleur, 
        couleur.id as couleurID
        FROM article
        INNER JOIN taille ON article.id_taille = taille.id  
        INNER JOIN couleur ON article.id_couleur = couleur.id
        LEFT JOIN panier_article ON article.id = panier_article.id_article
        WHERE panier_article.id_panier = :panier  AND visible = 1
        ORDER BY article.id ASC;";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":panier", $panierID, PDO::PARAM_INT);

        $stmt->execute();
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $datas;
    }

    /*
    SELECT id_article FROM `panier_article` 
INNER JOIN article ON article.id = panier_article.id_article
WHERE article.visible = 0 AND id_panier = 17;


DELETE FROM `panier_article` 
WHERE id_article = 6 AND id_panier =17*/

    /* supprime un article du panier */
    public function supprimerArticle($articleID, $panierID)
    {
        $req = "DELETE FROM `panier_article` 
        WHERE id_panier = :panier 
        AND id_article = :article";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":panier", $panierID, PDO::PARAM_INT);
        $stmt->bindValue(":article", $articleID, PDO::PARAM_INT);

        $stmt->execute();
        $datas = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $datas;
    }
    #endregion

    public function livraison()
    {
        $req = "SELECT 
        utilisateur.id as id, utilisateur.prenom as prenom, utilisateur.nom as nom, utilisateur.telephone as telephone,
        colissimo.id as Cid, colissimo.code_postal as Ccode_postal, colissimo.ville as Cville, colissimo.adresse as Cadresse, colissimo.lieu_dit_bp as Clieu_dit, colissimo.batiment_immeuble as Cbatiment_immeuble, colissimo.appartement_etage as Cappartement_etage, colissimo.defaut as Cdefaut,
        mondial_relay.id as MRid, mondial_relay.nom_enseigne as MRnom_enseigne, mondial_relay.code_postal as MRcode_postal, mondial_relay.ville as MRville, mondial_relay.adresse as MRadresse, mondial_relay.defaut as MRdefaut
        FROM `utilisateur`
                LEFT JOIN mondial_relay ON mondial_relay.id = utilisateur.id_mondial_relay  
                LEFT JOIN colissimo ON colissimo.id = utilisateur.id_colissimo
                WHERE utilisateur.id = :id;";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $_SESSION['profil']['id'], PDO::PARAM_INT);

        $stmt->execute();
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $datas;
    }
}
