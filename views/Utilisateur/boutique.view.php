<style>
    #filtre {
        padding-top: 5px;
    }

    #col {
        margin-bottom: 50px;
    }

    #couleur {
        margin-left: 10px;
        width: 30px;
        height: 30px;
        border-radius: 20px;
        border: solid thin grey;
    }


    #nom {
        text-transform: uppercase;
        font-weight: bold;
    }

    #ancienPrix {
        text-decoration: line-through;
    }

    #article {
        text-align: left;
        text-decoration: none;
        border: none;
        background-color: white;
    }



    /* MEDIA REPSONSIIVE */

    /* bureau */
    @media screen and (min-width: 768px) {
        #article img {
            width: 250px;
        }


        #filtres {

            width: 50%;
            margin-left: auto;
            margin-right: auto;
        }
    }

    /* tablette */
    @media screen and (min-width: 576px) and (max-width: 768px) {
        #article img {
            width: 200px
        }
    }

    /* tel */
    @media screen and (max-width: 576px) {
        #article img {
            width: 300px;
        }
    }







    #article:hover {
        background-color: rgb(244, 244, 244);
    }

    #categorie {
        padding: 0px;
        padding-right: 5px;
    }

    #annuler {
        margin-top: 10px;
    }
</style>


<div class="container">
    <div id="filtres">
        <div class="row mb-4">

            <div class="col-4" id="categorie">
                <form method="POST" action="<?= URL ?>boutique/filtreCategorie">
                    <select class="form-select" name="categorie" onchange="submit()">
                        <option value="0"> Categorie </option>
                        <?php foreach ($filtreCategorie as $filtre) { ?>
                            <option value="<?= $filtre['id'] ?>" <?= $filtre['id'] == $_SESSION['filtre']["categorie"] ? "selected" : "" ?>> <?= $filtre['nom'] ?> </option>
                        <?php } ?>
                    </select>
                </form>
            </div>





            <div class="col-4" id="categorie">
                <form method="POST" action="<?= URL ?>boutique/filtreTaille">
                    <select class="form-select" name="taille" onchange="submit()">
                        <option value="0"> Taille </option>
                        <?php foreach ($filtreTaille as $filtre) { ?>
                            <option value="<?= $filtre['id'] ?>" <?= $filtre['id'] == $_SESSION['filtre']["taille"] ? "selected" : "" ?>> <?= $filtre['nom'] ?> </option>
                        <?php } ?>
                    </select>
                </form>
            </div>





            <div class="col-4" id="categorie">
                <form method="POST" action="<?= URL ?>boutique/filtreCouleur">
                    <select class="form-select" name="couleur" onchange="submit()">
                        <option value="0"> Couleur </option>
                        <?php foreach ($filtreCouleur as $filtre) { ?>
                            <option value="<?= $filtre['id'] ?>" <?= $filtre['id'] == $_SESSION['filtre']["couleur"] ? "selected" : "" ?>> <?= $filtre['nom'] ?> </option>
                        <?php } ?>
                    </select>
                </form>
            </div>


            <div class="col-12 text-center" id="annuler">

                <form method="POST" action="<?= URL ?>boutique/filtreCancel">
                    <button type="submit" class="btn btn-info">Annuler les filtres</button>
                </form>
            </div>

        </div>

        <!-- <div class="col-12 text-center">
            <button class="btn btn-info" id="btnAnnulModif" style="margin-left: 20px;" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                </svg>
            </button>
        </div> -->

    </div>


    <?php if (empty($article)) { ?>

        <h2 class="text-center">Les filtres choisis ne mènent à aucun résultat</h2>
    <?php
    }

    ?>



    <div class="row">
        <?php
        $m = 0;
        foreach ($article as $Article) { ?>
            <div class="col-xl-3 col-sm-6 col-s-8 text-center" id="col">
                <form method="POST" action="article" class="mt-1" id="form">
                    <button id="article">
                        <input type="hidden" class="form-control" value="<?= $Article['id'] ?>" id="articleID" name="articleID">
                        <input type="hidden" class="form-control" value="<?= $Article['nom'] ?>" id="articleNOM" name="articleNOM">
                        <input type="hidden" class="form-control" value="<?= $Article['couleurID'] ?>" id="couleurID" name="couleurID">

                        <!-- image -->
                        <div id="text">
                            <img src="<?= URL; ?>public/Assets/images/article/<?= $Article['image'] ?>" alt="<?= $Article['image'] ?>">
                        </div>

                        <!-- nom -->
                        <div id="nom">
                            <?= $Article['nom']; ?>
                        </div>

                        <!-- couleur -->
                        <div class="row">

                            <?php for ($j = 0; $j < count($couleur[$m]); $j++) { ?>
                                <div id="couleur" style=" background-color: #<?= $couleur[$m][$j]['hexadecimal'] ?>; "> &nbsp; </div>
                            <?php } ?>
                        </div>

                        <!-- taille -->
                        <div id="taille">
                            <?php for ($j = 0; $j < count($taille[$m]); $j++) {
                                echo $taille[$m][$j]['taille'] . " ";
                            }
                            $m++; ?>
                        </div>

                        <!-- prix -->
                        <div id="prix">
                            <div class="row">
                                <?php if ((int)$Article['promotion'] != 0 &&  (int)$Article['promotion'] < (int)$Article['prix'] && (int)$Article['prix'] > 0) { ?>
                                    <div class="col-1 line" id="ancienPrix"><?= (int)$Article['prix']; ?>€ </div>
                                    <div class="col-1"><?= "&nbsp;&nbsp;" . (int)$Article['promotion']; ?>€ </div>
                                <?php } else { ?>
                                    <div class="col-1"><?= (int)$Article['prix']; ?>€ </div>
                                <?php } ?>
                            </div>
                        </div>
                    </button>
                </form>
            </div>
        <?php }   ?>
    </div>
</div>