<div>
    <form method="POST" action="<?= URL ?>administration/ajouterArticle" enctype="multipart/form-data">

        <!-- Image -->
        <div>
            <label for="image"> Ajouter une image</label>
            <input type="file" class="form-control-file" name="image" />
        </div>


        <!-- Nom -->
        <div>
            <label for="nom">Nom</label>
            <input type="text" name="nom">
        </div>


        <!-- Prix -->
        <div>
            <label for="prix">Prix</label>
            <input type="text" name="prix">
        </div>


        <!-- Promotion -->
        <div>
            <label for="promotion">Promotion</label>
            <input type="text" name="promotion">
        </div>


        <!-- Catégorie -->
        <div>
            <label for="id_categorie">Catégorie</label>
            <select name="idCategorie">
                <option value=""> </option>
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
        </div>


        <!-- Couleur -->
        <div>
            <label for="idCouleur">Couleur</label>
            <select name="idCouleur">
                <option value=""> </option>
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
        </div>


        <!-- Taille -->
        <div>
            <label for="idTaille">Taille</label>
            <select name="idTaille">
                <option value=""> </option>
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
        </div>

        <button type="submit">Valider</button>
    </form>
</div>