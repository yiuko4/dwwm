<?php $total = 0; ?>
<?php $prix_article = 0; ?>
<a id="retour" href="accueil">
    retour à la boutique </a>

<body>


    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Nom</th>
                <th>Couleur</th>
                <th>Taille</th>
                <th>Prix</th>
                <th></th>
            </tr>
            <?php foreach ($panier as $Panier) : ?>
                <tr>
                    <td> <img src="<?= URL; ?>public/Assets/images/article/<?= $Panier['image'] ?>" width="50px" alt="<?= $Panier['image'] ?>"></td>

                    <td><?= $Panier['nom']; ?></td>
                    <td><?= $Panier['couleur']; ?></td>
                    <td><?= $Panier['taille']; ?></td>
                    <td>
                        <div class="row">
                            <?php if ((int)$Panier['promotion'] != 0 &&  (int)$Panier['promotion'] < (int)$Panier['prix'] && (int)$Panier['prix'] > 0) { ?>
                                <div class="col-1 line" id="ancienPrix"><?= (int)$Panier['prix']; ?>€ </div>
                                <div class="col-1"><?= "&nbsp;&nbsp;" . (int)$Panier['promotion']; ?>€ </div>
                                <?php $prix_article = $Panier['promotion']; ?>

                            <?php } else { ?>
                                <div class="col-1"><?= (int)$Panier['prix']; ?>€ </div>
                                <?php $prix_article = $Panier['prix']; ?>
                            <?php } ?>

                        </div>
                    </td>
                    <td>
                        <!-- bouton de suppression d'article -->
                            <button type="submit" class="btn btn-outline-warning" name="articleID" value="<?= $Panier['id']; ?>"> Supprimer </button>
                      
                    </td>
                </tr>

                <?php $total += $prix_article; ?>
            <?php endforeach;
            ?>
        </thead>
    </table>


    <div class="row mt-5">
        <!-- si le panier est vide -->
        <?php if (count($panier) == 0) { ?>
            <h2 class="text-center"> Votre Panier est vide</h2>

        <?php } else { ?>

            <!-- si le panier estcomprend au moins un article -->
            <h2 class="col" style="text-align:right;">
                <?= count($panier) ?> <?= ($total > 1) ? "articles" : "article"; ?>
            </h2>

            <h2 class="col" style="text-align:center;">
                Total : <?= $total ?>€
            </h2>
        <?php } ?>
    </div>

    <div class="text-center ">
        <form method="POST" action="commande">
            <button type="submit" class="btn btn-info btn-lg" name="articleID" value="<?= $Panier['id']; ?>"> Passer la commande </button>
        </form>
    </div>

</body>
<style>
    /* MEDIA REPSONSIIVE */
    /* bureau */
    @media screen and (min-width: 768px) {}

    /* tablette */
    @media screen and (min-width: 576px) and (max-width: 768px) {}

    /* tel */
    @media screen and (max-width: 576px) {
        body {
            width: 100%;
        }
    }

    #retour {
        text-decoration: none;
        color: black;
        text-transform: uppercase;
    }

    #ancienPrix {
        text-decoration: line-through;
    }
</style>

<?php
$total = 0;
$prix_article = 0;
error_reporting(0);
?>
<a id="retour" href="accueil">
    retour à la boutique </a>


<?php foreach ($panier as $Panier) : ?>


    <div id="panier">
        <div class="row">
            <div class="col-2 mb-4">
                <img src="<?= URL; ?>public/Assets/images/article/<?= $Panier['image'] ?>" width="50px" alt="<?= $Panier['image'] ?>">
            </div>
            <div class="col-8">
                <div id="nom"><?= $Panier['nom']; ?></div>
                <div id="couleur">Couleur : <?= $Panier['couleur']; ?></div>
                <div id="taille">Taille : <?= $Panier['taille']; ?></div>
            </div>
            <?php if ((int)$Panier['promotion'] != 0 &&  (int)$Panier['promotion'] < (int)$Panier['prix'] && (int)$Panier['prix'] > 0) { ?>
                <div class="col-1 position-right">

                    <div id="ancienPrix"><?= (int)$Panier['prix']; ?>€ </div>
                    <div> <?= $prix_article = $Panier['promotion'];
                            (int)$Panier['promotion']; ?>€ </div>

                </div>

            <?php } else { ?>
                <div class="col-1">
                    <div>&nbsp</div>
                    <div><?= (int)$Panier['prix']; ?>€</div>
                </div>
                <?php $prix_article = $Panier['prix']; ?>
            <?php } ?>
            <div class="col-1">
                <form action=""></form>
                <button type="submit" class="btn btn-outline-warning" name="articleID" value="<?= $Panier['id']; ?>"> X </button>

            </div>



        </div>
    </div>

    <?php $total += $prix_article; ?>
<?php endforeach;
?>




<div id="panier">
    <div class="row align-center">
        <!-- si le panier est vide -->
        <?php if (count($panier) == 0) { ?>
            <h2 class="text-center"> Votre Panier est vide</h2>

        <?php } else { ?>

            <!-- si le panier estcomprend au moins un article -->
            <h2 class="col">
                <?= count($panier) ?> <?= ($total > 1) ? "articles" : "article"; ?>
            </h2>

            <h2 class="col">
                Total : <?= $total ?>€
            </h2>
            <div class="text-center">
                <form method="POST" action="commande">
                    <button type="submit" class="btn btn-info btn-lg" name="articleID" value="<?= $Panier['id']; ?>"> Passer la commande </button>
                </form>
            </div>
        <?php } ?>
    </div>
</div>


</body>



<style>
    /* MEDIA REPSONSIIVE */
    /* bureau */
    @media screen and (min-width: 768px) {
        #panier {

            margin-left: auto;
            margin-right: auto;
            width: 50%
        }
    }

    /* tablette */
    @media screen and (min-width: 576px) and (max-width: 768px) {}

    /* tel */
    @media screen and (max-width: 576px) {


        #panier {
            margin-left: 20px;
            margin-right: 20px;
        }
    }

    #retour {
        text-decoration: none;
        color: black;
        text-transform: uppercase;
    }

    #ancienPrix {
        text-decoration: line-through;
    }
</style>