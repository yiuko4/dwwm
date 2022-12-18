<h2>voir les articles</h2>

<div class="row mb-5 text-center">
    <div class="col-9">
        <div class="input-group">
            <input class="form-control mr-sm-2" type="search" placeholder="Votre recherche.." aria-label="Search">
            <button class="btn btn-success my-2 my-sm-0" type="submit">Rechercher</button>
            <button class="btn btn-warning  my-2 my-sm-0" type="submit">Annuler</button>
        </div>
    </div>
    <div class="col-3">
        <form method="POST" action="formulaireAjoutArticle">
            <button type="submit" class="btn btn-primary"> Ajouter un article </button>
        </form>
    </div>
</div>




<table class="table">
    <thead>
        <tr>
            <th>Image</th>
            <th>Nom</th>
            <th>Couleur</th>
            <th>Taille</th>
            <th>Prix</th>
            <th></th>
        </tr>
        <?php foreach ($viewArticles as $Articles) : ?>

            <tr <?php if ($Articles['visible'] == 0) { ?>style="background-color: #f5f5f5;" <?php } ?>>


                <td> <img src="<?= URL; ?>public/Assets/images/article/<?= $Articles['image'] ?>" width="100px" alt="<?= $Articles['image'] ?>"></td>

                <td><?= $Articles['nom']; ?></td>
                <td><?= $Articles['couleur']; ?></td>
                <td><?= $Articles['taille']; ?></td>
                <td>
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
                </td>
                <td>
                    <!-- bouton pour modifier un article -->
                    <form method="POST" action="modifier_un_article">
                        <input type="hidden" class="form-control" value="<?= $Articles['id'] ?>" id="articleID" name="articleID">
                        <button type="submit" class="btn btn-outline-primary mb-2" name="articleID" value="<?= $Articles['id']; ?>"> Modifier </button>
                    </form>
                    <!-- bouton pour cacher un article -->
                    <form method="POST" action="cacher_un_article">
                        <button type="submit" name="id" <?php if ($Articles['visible'] == 0) { ?> class="btn btn-warning mb-2" <?php } else { ?> class="btn btn-outline-warning mb-2" <?php } ?> value="<?= $Articles['id']; ?>"> Cacher </button>

                    </form>
                    <!-- bouton pour supprimer un article -->
                    <form method="POST" action="supprimer_un_article">
                        <button type="submit" class="btn btn-outline-danger mb-2" name="id" value="<?= $Articles['id']; ?>"> Supprimer </button>
                    </form>
                </td>
            </tr>
        <?php endforeach;
        ?>
</table>


<style>
    #ancienPrix {
        text-decoration: line-through;
    }
</style>