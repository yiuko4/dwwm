<h2>voir les articles</h2>


<div class="col-12 text-center mb-5 mt-3 ">
    <form method="POST" action="formulaireAjoutArticle">
        <button type="submit" class="btn btn-primary"> Ajouter un article </button>
    </form>
</div>


<div class="container">
    <div class="row ">
        <div class="col-2">Image</div>
        <div class="col-2">Nom</div>
        <div class="col-2">Couleur</div>
        <div class="col-2">Taille</div>
        <div class="col-2">Prix</div>

    </div>

    <?php foreach ($viewArticles as $Articles) : ?>
        <div class="row  pb-4 pt-4 border-bottom" <?php if ($Articles['visible'] == 0) { ?>style="background-color: #f5f5f5;" <?php } ?>>
            <div class="col-2"><img src="<?= URL; ?>public/Assets/images/article/<?= $Articles['image'] ?>" width="100px" alt="<?= $Articles['image'] ?>"></div>
            <div class="col-2"><?= $Articles['nom']; ?></div>
            <div class="col-2"><?= $Articles['couleur']; ?></div>
            <div class="col-2"><?= $Articles['taille']; ?></div>
            <div class="col-2">
                <div class="row">
                    <?php if ((int)$Articles['promotion'] != 0 &&  (int)$Articles['promotion'] < (int)$Articles['prix'] && (int)$Articles['prix'] > 0) { ?>
                        <div class="col-1 line" id="ancienPrix"><?= (int)$Articles['prix']; ?>€ </div>
                        <div class="col-1"><?= "&nbsp;&nbsp;" . (int)$Articles['promotion']; ?>€ </div>
                        <?php $prix_article = $Articles['promotion']; ?>

                    <?php } else { ?>
                        <div class="col-1"><?= (int)$Articles['prix']; ?>€ </div>
                        <?php $prix_article = $Articles['prix']; ?>
                    <?php } ?>

                </div>
            </div>
            <div class="col-1">
                <div class="row">
                    <form method="POST" action="modifier_un_article">
                        <button type="submit" class="btn btn-outline-primary mb-2" name="articleID" value="<?= $Articles['id']; ?>"> Modifier </button>
                    </form>
                    <form method="POST" action="cacher_un_article">
                        <button type="submit" name="id" <?php if ($Articles['visible'] == 0) { ?> class="btn btn-warning mb-2" <?php } else { ?> class="btn btn-outline-warning mb-2" <?php } ?> value="<?= $Articles['id']; ?>"> Cacher </button>

                    </form>
                    <!-- bouton pour supprimer un article -->
                    <form method="POST" action="supprimer_un_article">
                        <button type="submit" class="btn btn-outline-danger mb-2 " name="id" value="<?= $Articles['id']; ?>"> Supprimer </button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>





<style>
    #ancienPrix {
        text-decoration: line-through;
    }
</style>