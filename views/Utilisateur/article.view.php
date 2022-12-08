<a id="retour" href="accueil">
    retour à la boutique </a>
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
                        <button <?php if ($Taille['id'] == $article['id']) { ?> style="color:red" ; <?php } ?> id="boutontaille" type="submit"> <?= $Taille['taille'] ?> </button>
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
                        <button <?php if ($Couleur['couleurID'] == $article['couleurID']) { ?> style="border:solid red; background-color: #<?= $Couleur['hexadecimal'] ?>" ; <?php } ?> id="boutoncouleur" type="submit" style="background-color: #<?= $Couleur['hexadecimal'] ?> ;"> &nbsp; </button>
                    </form>
                <?php } ?>
            </div>
            <!-- prix -->
            <div id="prix">
                <div class="row" id="affichePrix">
                    <?php if ((int)$article['promotion'] != 0 &&  (int)$article['promotion'] < (int)$article['prix'] && (int)$article['prix'] > 0) { ?>
                        <div class="col-1 line" id="ancienPrix" style="color: red; font-weight: 500;"><?= (int)$article['prix']; ?>€ </div>
                        <div class="col-1" style="color: green; font-weight: 500;"><?= "&nbsp;&nbsp;" . (int)$article['promotion']; ?>€ </div>
                    <?php } else { ?>
                        <div class="col-1" id="baseprix" style="color: green; font-weight: 500;"><?= (int)$article['prix']; ?>€ </div>
                    <?php } ?>

                </div>

            </div>
            <!-- nom -->
            <h2 id="nom"><?= $article['nom']; ?></h2>
            <form method="POST" action="articlepanier/" id="btnPanier">
                <input type="hidden" class="form-control" value="<?= $article['id'] ?>" id="articleID" name="articleID">
                <button type="submit" class="btn btn-outline-warning"> Ajouter au Panier </button>
            </form>

        </div>
    </div>
</div>


<style>
    /* MEDIA REPSONSIIVE */
    /* bureau */
    @media screen and (min-width: 768px) {
        #nom {
            text-align: left;

        }

        #btnPanier {
            text-align: left;
            margin-top: -50px;
            margin-left: -70px;
        }
    }

    /* tablette */
    @media screen and (min-width: 576px) and (max-width: 768px) {}

    /* tel */
    @media screen and (max-width: 576px) {

        #nom {
            margin-top: -40px;
        }

        #btnPanier {
            text-align: left;
            margin-top: -50px;
            margin-left: 25px;
        }



        #container {

            text-align: center;
        }

        #formulaire {
            margin-top: -25px;
            margin-left: 50px;
        }

        #affichePrix {
            margin-left: auto;
            margin-right: auto;
            font-size: 2em;
            width: 120px;
        }

        #ancienPrix {
            text-decoration: line-through;
            margin-left: -20px;
            margin-right: 50px;

        }

        #baseprix {
            margin-left: 20px;
            margin-top: -10px;

        }


    }


    #retour {
        text-decoration: none;
        color: black;
        text-transform: uppercase;
    }

    #boutontaille {
        border: none;
        background-color: white;

    }

    #boutontaille:hover {
        color: green;
    }

    #boutoncouleur {
        display: inline-block;
        border: solid thin grey;
        margin: 2px;
        font-size: 24px;
        cursor: pointer;
        width: 30px;
        height: 30px;
        border-radius: 50%;
    }

    #boutoncouleur:hover {
        border: solid green;

    }

    #article {
        margin: 5px;
        padding-top: 15px;
        padding-bottom: 5px;
        height: 60px;
    }


    #ancienPrix {
        text-decoration: line-through;

    }

    #image {
        height: 400px;
        display: block;
        margin: 0px auto;
    }

    h2 {
        padding-top: 50px;
    }

    .row {
        padding-top: 20px;
    }

    .btn {
        margin-top: 100px;
        margin-left: 70px;
    }

    .taille {
        text-decoration: none;
    }

    .couleur {
        text-decoration: none;
    }
</style>