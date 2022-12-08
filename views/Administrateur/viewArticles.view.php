<h2>voir les articles</h2>

<!-- <?= var_dump($viewArticles) ?> -->
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
            <tr>
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
                        <button type="submit" class="btn btn-outline-warning mb-2" name="articleID" value="<?= $Articles['id']; ?>"> Cacher </button>
                    </form>
                    <!-- bouton pour supprimer un article -->
                    <form method="POST" action="supprimer_un_article">
                        <button type="submit" class="btn btn-danger mb-2" name="articleID" value="<?= $Articles['id']; ?>"> Supprimer </button>
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