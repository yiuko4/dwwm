<?php
$total = 0;
$prix_article = 0;
error_reporting(0);
?>



<div style="padding-top: 50px;"></div>
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
                    <button type="submit" class="btn" id="suppr" name="articleID" value="<?= $Panier['id']; ?>"> X </button>
                </form>

            </div>



        </div>

    </div>
    <?php $total += $prix_article; ?>
<?php endforeach;
?>


<div style="padding-top: 50px;"></div>
<div id="panier" class="mt-4">

    <!-- si le panier est vide -->
    <?php if (count($panier) == 0) { ?>
        <h2 class="text-center"> Votre Panier est vide</h2>
        <div class="text-center pt-4" >
            <form method="POST" action="accueil">
                <button type="submit" id="accueil" class="btn"> Retour à l'accueil</button>
            </form>
        </div>
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
                <button type="submit" id="commande" class="btn " name="articleID" value="<?= $Panier['id']; ?>"> Passer la commande </button>
            </form>
        </div>
    <?php } ?>

</div>

</div>
</body>


