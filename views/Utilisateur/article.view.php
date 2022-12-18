<!--<div>
    <a id="retour" href="accueil">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
            <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
        </svg>
    </a>
</div>-->





<div class="container">
    <div class="row">
        <div class="h-100 col" id="article">
            <img id="image" src="<?= URL; ?>public/Assets/images/article/<?= $article['image'] ?>" alt="<?= $article['image'] ?>">

        </div>


        <div id="container-bot" class="h-100 col text-center">
            <!-- HHHHHHHHHHHHHHHHHHHHHH -->

            <!-- taille -->
            <h3 class="row text-center" id="formulaire">
                <?php foreach ($taille as $Taille) { ?>
                    <form class="col-2 col-sm-2 col-md-2 col-lg-1 col-xl-1 mt-1" method="POST" action="article">
                        <input type="hidden" class="form-control" value="<?= $Taille['id'] ?>" id="articleID" name="articleID">
                        <input type="hidden" class="form-control" value="<?= $Taille['nom'] ?>" id="articleNOM" name="articleNOM">
                        <input type="hidden" class="form-control" value="<?= $Taille['couleurID'] ?>" id="couleurID" name="couleurID">
                        <button <?php if ($Taille['id'] == $article['id']) { ?> style="color:#2274A5" ; <?php } ?> id="boutontaille" type="submit"> <?= $Taille['taille'] ?> </button>
                    </form>
                <?php } ?>
            </h3>

            <!-- couleur -->
            <div class="row text-center" id="formulaire">
                <?php foreach ($couleur as $Couleur) { ?>
                    <form class="col-2 col-sm-2 col-md-2 col-lg-1 col-xl-1 mt-1" method="POST" action="article">
                        <input type="hidden" class="form-control" value="<?= $Couleur['id'] ?>" id="articleID" name="articleID">
                        <input type="hidden" class="form-control" value="<?= $Couleur['nom'] ?>" id="articleNOM" name="articleNOM">
                        <input type="hidden" class="form-control" value="<?= $Couleur['couleurID'] ?>" id="couleurID" name="couleurID">
                        <button <?php if ($Couleur['couleurID'] == $article['couleurID']) { ?> style="border:solid #2274A5; background-color: #<?= $Couleur['hexadecimal'] ?>" ; <?php } ?> id="boutoncouleur" type="submit" style="background-color: #<?= $Couleur['hexadecimal'] ?> ;"> &nbsp; </button>
                    </form>
                <?php } ?>
            </div>
            <!-- prix -->
            <div id="prix">
                <div class="row" id="affichePrix">
                    <?php if ((int)$article['promotion'] != 0 &&  (int)$article['promotion'] < (int)$article['prix'] && (int)$article['prix'] > 0) { ?>
                        <div class="col-1 line" id="ancienPrix" style="color: #816C61; font-weight: 500;"><?= (int)$article['prix']; ?>€ </div>
                        <div class="col-1" style="color: #2274A5; font-weight: 500;"><?= "&nbsp;&nbsp;" . (int)$article['promotion']; ?>€ </div>
                    <?php } else { ?>
                        <div class="col-1" id="baseprix" style="color: #2274A5; font-weight: 500;"><?= (int)$article['prix']; ?>€ </div>
                    <?php } ?>

                </div>

            </div>
            <!-- nom -->
            <h1 id="nom"><?= $article['nom']; ?></h1>
            <form method="POST" action="articlepanier/" id="btnPanier">
                <input type="hidden" class="form-control" value="<?= $article['id'] ?>" id="articleID" name="articleID">
                <button type="submit" id="button" class="btn"> Ajouter au Panier </button>
            </form>

        </div>
    </div>
</div>