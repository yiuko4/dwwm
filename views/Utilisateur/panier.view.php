<?php
$total = 0;
$prix_article = 0;
error_reporting(0);
?>
<a id="retour" href="accueil">
    retour à la boutique </a>


<?php foreach ($panier as $Panier) : ?>


    <div id="panier">
        <div class="row mb-4">
            <div class="col-2 mb-3">
                <img src="<?= URL; ?>public/Assets/images/article/<?= $Panier['image'] ?>" width="50px" alt="<?= $Panier['image'] ?>">
            </div>
            <div class="col-7">
                <div id="nom"><?= $Panier['nom']; ?></div>
                <div id="couleur">Couleur : <?= $Panier['couleur']; ?></div>
                <div id="taille">Taille : <?= $Panier['taille']; ?></div>
            </div>
            <?php if ((int)$Panier['promotion'] != 0 &&  (int)$Panier['promotion'] < (int)$Panier['prix'] && (int)$Panier['prix'] > 0) { ?>
                <div class="col-1 position-right">

                    <div id="ancienPrix"><?= (int)$Panier['prix']; ?>€ </div>
                    <div id="prix"> <?= $prix_article = $Panier['promotion'];
                                    (int)$Panier['promotion']; ?>€ </div>

                </div>

            <?php } else { ?>
                <div class="col-1">
                    <div>&nbsp</div>
                    <div id="prix"><?= (int)$Panier['prix']; ?>€</div>
                </div>
                <?php $prix_article = $Panier['prix']; ?>
            <?php } ?>
            <div class="col-1">
                <form method="POST" action="supprimerArticle">
                    <button type="submit" class="btn btn-outline-warning" id="suppr" name="articleID" value="<?= $Panier['id']; ?>"> X </button>
                </form>

            </div>



        </div>
    </div>

    <?php $total += $prix_article; ?>
<?php endforeach;
?>




<div id="panier" class="mt-4">

    <!-- si le panier est vide -->
    <?php if (count($panier) == 0) { ?>
        <h2 class="text-center"> Votre Panier est vide</h2>

    <?php } else { ?>
        <div class="row mb-3">
            <div class="col-2"></div>
            <!-- si le panier estcomprend au moins un article -->
            <div class="col-5" id="nbArticles">
                <?= count($panier) ?> <?= ($total > 1) ? "articles" : "article"; ?>
            </div>

            <div class="col-4" id="total">
                Total : <?= $total ?>€
            </div>

        </div>
        <div class="text-center" id="btnCommande">
            <form method="POST" action="commande">
                <button type="submit" class="btn btn-info " name="articleID" value="<?= $Panier['id']; ?>"> Passer la commande </button>
            </form>
        </div>
    <?php } ?>

</div>


</body>



<style>
    /* MEDIA REPSONSIIVE */
    /* bureau */
    @media screen and (min-width: 768px) {
        #nbArticles {
            font-size: 2em;
        }

        #total {
            font-size: 2em;
            text-align: right;
        }

        #panier {

            margin-left: auto;
            margin-right: auto;
            width: 50%
        }

        #suppr {
            margin-top: 30px;
            margin-left: 10px;
        }

        #btnCommande {
            margin-top: 30px;
        }
    }

    /* tablette */
    @media screen and (min-width: 576px) and (max-width: 768px) {}

    /* tel */
    @media screen and (max-width: 576px) {
        #suppr {
            margin-top: 18px;
            margin-left: 10px;
        }

        #panier {
            margin-left: 20px;
            margin-right: 20px;
        }

        #nbArticles {
            font-weight: 700;
        }

        #total {
            font-weight: 700;
            text-align: right;
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

    #nom {
        font-weight: 700;
    }

    #prix {
        font-weight: 700;

    }
</style>