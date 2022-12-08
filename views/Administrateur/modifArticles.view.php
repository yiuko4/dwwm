<h2>modifier les articles</h2>

<!--   <?= var_dump($modifArticle) ?>  -->
<img src="<?= URL; ?>public/Assets/images/article/<?= $modifArticle['image'] ?>" width="100px" alt="<?= $modifArticle['image'] ?>">
<div> nom
    <input type="text" value="<?= $modifArticle['nom']; ?>" />
</div>
<div> couleur
    <input type="text" value="<?= $modifArticle['couleur']; ?>" />
    <div>
        taille
        <input type="text" value="<?= $modifArticle['taille']; ?>" />
    </div>
    <div>
        prix
        <input type="text" value="<?= $modifArticle['prix']; ?>" />
    </div>
    <div>
        promotion
        <input type="text" value="<?= $modifArticle['promotion']; ?>" />
    </div>



    <!-- bouton pour valider la modification d'un article -->
    <form method="POST" action="validerModifiee">
        <button type="submit" class="btn btn-outline-primary mb-2" name="articleID" value="<?= $modifArticle['id']; ?>"> Valider </button>
    </form>
    <!-- bouton pour annuler la modification d'un article -->
    <form method="POST" action="articles">
        <button type="submit" class="btn btn-outline-warning mb-2" name="articleID" value="<?= $modifArticle['id']; ?>"> Annuler </button>
    </form>

