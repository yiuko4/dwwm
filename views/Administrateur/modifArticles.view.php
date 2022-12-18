<div class="container">
    <form method="POST" action="validation_modifier_un_article" enctype="multipart/form-data">

        <!-- Nom -->
        <div class="row">
            <div class="col-6">

                <div id="icon">
                    <img src="<?= URL; ?>public/Assets/images/article/<?= $modifArticle['image'] ?>" alt="your image" width="450px" />
                </div>
                <div id="photo" style="display: none;">
                    <img id="image" src="#" alt="your image" width="450px" />
                </div>
            </div>

            <div class="col-6">
                <div class="input-group mb-3">
                    <label for="nom" class="input-group-text">Nom</label>
                    <input type="text" name="nom" id="nom" class="form-control" value="<?= $modifArticle['nom'] ?>">
                </div>

                <div class="input-group mb-3">
                    <label for="prix" class="input-group-text">Prix</label>
                    <input type="text" name="prix" id="prix" class="form-control" value="<?= $modifArticle['prix'] ?>">
                </div>

                <div class="input-group mb-3">
                    <label for="promotion" class="input-group-text">Promotion</label>
                    <input type="text" name="promotion" id="promotion" class="form-control" value="<?= $modifArticle['promotion'] ?>">
                </div>
                <?php
                $idCategorie = $modifArticle['categorie'];
                switch ($idCategorie) {
                    case "1":
                        $categorie = "Java";
                        break;
                    case "2":
                        $categorie = "Little Miss";
                        break;
                    case "3":
                        $categorie = "Miss";
                        break;
                    case "4":
                        $categorie = "Trend";
                        break;
                }
                ?>
                <div class="input-group mb-3">
                    <label for="categorie" class="input-group-text">Catégorie</label>
                    <select name="idCategorie" id="categorie" class="nav-link dropdown-toggle">
                        <option value="<?= $idCategorie ?>"><?= $categorie ?></option>
                        <option value="1">Java </option>
                        <option value="2">Little Miss</option>
                        <option value="3">Miss</option>
                        <option value="4">Trend</option>
                    </select>
                </div>
                <?php
                $idCouleur = $modifArticle['couleur'];
                switch ($idCouleur) {
                    case 1:
                        $couleur = "Bleu";
                        break;
                    case 2:
                        $couleur = "Marron";
                        break;
                    case 3:
                        $couleur = "Noir";
                        break;
                    case 4:
                        $couleur = "Vert";
                        break;
                    case 5:
                        $couleur = "Gris";
                        break;
                    case 6:
                        $couleur = "Orange";
                        break;
                    case 7:
                        $couleur = "Rouge";
                        break;
                    case 8:
                        $couleur = "Violet";
                        break;
                    case 9:
                        $couleur = "Blanc";
                        break;
                    case 10:
                        $couleur = "Jaune";
                        break;
                    case 11:
                        $couleur = "Rose";
                        break;
                }
                ?>

                <div class="input-group mb-3">
                    <label for="couleur" class="input-group-text">Couleur</label>
                    <select name="idCouleur" id="couleur" class="nav-link dropdown-toggle">
                        <option value="<?= $idCouleur ?>"><?= $couleur ?></option>
                        <option value="4" style="background-color:#0000FF; color: white; ">Bleu</option>
                        <option value="2" style="background-color:#582900; color: white;">Marron</option>
                        <option value="3" style="background-color:#000000; color: white;">Noir</option>
                        <option value="1" style="background-color:#008000; color: white; ">Vert</option>
                        <option value="5" style="background-color:#606060; color: white;">Gris</option>
                        <option value="6" style="background-color:#ff7f00; color: white;">Orange</option>
                        <option value="7" style="background-color:#850606; color: white;">Rouge</option>
                        <option value="8" style="background-color:#7f00ff; color: white;">Violet</option>
                        <option value="9" style="background-color:#f8f8ff;">Blanc</option>
                        <option value="10" style="background-color:#ffe436;">Jaune</option>
                        <option value="11" style="background-color:#fd6c9e; color: white;">Rose</option>
                    </select>
                </div>

                <?php
                $idTaille = $modifArticle['taille'];
                switch ($idTaille) {
                    case 1:
                        $taille = "S";
                        break;
                    case 2:
                        $taille = "M";
                        break;
                    case 3:
                        $taille = "L";
                        break;
                    case 4:
                        $taille = "XL";
                        break;
                }
                ?>


                <div class="input-group mb-3">
                    <label for="taille" class="input-group-text">Taille</label>
                    <select name="idTaille" id="taille" class="nav-link dropdown-toggle">
                        <option value="<?= $idTaille ?>"><?= $taille ?></option>
                        <option value="1">S</option>
                        <option value="2">M</option>
                        <option value="3">L</option>
                        <option value="4">XL</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-6 text-center mt-3">
                        <button type="submit" id="button_valide" class="btn-lg mt-5" name="id" value="<?= $modifArticle['id']; ?>"> Modifier</button>

                    </div>


    </form>
    <div class="col-6 text-center mt-3">
        <form method="POST" action="articles">
            <button type="submit" id="button_annule" class="btn-lg mt-5"> Annuler</button>
        </form>
    </div>
</div>
</div>
</div>
</div>


<style>
    #button_valide {
        background-color: #2274A5 !important;
        color: white;
        border: none;
        padding: 15px;
    }

    #button_annule {
        background-color: #816c61 !important;
        color: white;
        border: none;
        padding: 15px;
    }



    #taille,
    #couleur,
    #categorie {
        width: 200px;
        border-radius: 5px;
        border-color: #ced4da;
        text-align: center;
    }
</style>
