<?php
require_once("./models/MainManager.model.php");

class AdministrateurManager extends MainManager
{

    public function getUtilisateurs()
    {
        $req = $this->getBdd()->prepare("SELECT * FROM utilisateur");
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $datas;
    }

    public function infoAjoutArticle($nom, $image, $prix, $promotion, $idCategorie, $idCouleur, $idTaille)
    {
        /* $req = "INSERT INTO article VALUES (NULL, :nom, :image, :prix, :promotion, 1, :idCategorie, :idCouleur, :idTaille)"; */
        $req = "INSERT INTO article VALUES (NULL, :nom, :image, :prix, :promotion, 1, 1, 1, 1)";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":nom", $nom, PDO::PARAM_STR);
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);
        $stmt->bindValue(":prix", $prix, PDO::PARAM_INT);
        $stmt->bindValue(":promotion", $promotion, PDO::PARAM_INT);
        /*$stmt->bindValue(":idCategorie", $idCategorie, PDO::PARAM_INT);
        $stmt->bindValue(":idCouleur", $idCouleur, PDO::PARAM_INT);
        $stmt->bindValue(":idTaille", $idTaille, PDO::PARAM_INT); */

        $stmt->execute();
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $datas;
    }
















    public function viewArticles()
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
        ORDER BY article.nom, taille.id ASC;
        ";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $datas;
    }

    public function modifArticle($articleID)
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
        WHERE article.id= :articleID";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":articleID", $articleID, PDO::PARAM_INT);

        $stmt->execute();
        $datas = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $datas;
    }


    public function hideArticle()
    {
        $req = "";
        $stmt = $this->getBdd()->prepare($req);
        /*         $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":role", $role, PDO::PARAM_STR); */
        $stmt->execute();
        $isModif = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $isModif;
    }

    public function deleteArticle()
    {
        $req = "";
        $stmt = $this->getBdd()->prepare($req);
        /*         $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":role", $role, PDO::PARAM_STR); */
        $stmt->execute();
        $isModif = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $isModif;
    }



    /*     public function bdModificationRoleUser($login, $role)
    {
        $req = "UPDATE utilisateur set role = :role WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":role", $role, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    } */
}
