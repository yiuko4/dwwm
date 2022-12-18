<div class="container">
    <form method="POST" action="<?= URL ?>administration/ajouterArticle" enctype="multipart/form-data">

        <!-- Nom -->
        <div class="row">
            <div class="col-6">

                <div id="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="400" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
                        <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1v6zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2z" />
                        <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zm0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7zM3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
                    </svg>
                </div>
                <div id="photo" style="display: none;">
                    <img id="image" src="#" alt="your image" width="450px" />
                </div>
            </div>




            <div class="col-6">
                <div class="input-group mb-3">
                    <label for="nom" class="input-group-text">Nom</label>
                    <input type="text" name="nom" id="nom" class="form-control" placeholder="de l'article">
                </div>


                <div class="mb-3">
                    <input type="file" id="imageinput" class="form-control form-control" name="image" />
                </div>


                <div class="input-group mb-3">
                    <label for="prix" class="input-group-text">Prix</label>
                    <input type="text" name="prix" id="prix" class="form-control" placeholder="en €">
                </div>

                <div class="input-group mb-3">
                    <label for="promotion" class="input-group-text">Promotion</label>
                    <input type="text" name="promotion" id="promotion" class="form-control" placeholder="pas obligatoire">
                </div>

                <div class="input-group mb-3">
                    <label for="categorie" class="input-group-text">Catégorie</label>
                    <select name="idCategorie" id="categorie" class="nav-link dropdown-toggle">
                        <option value="1">Java </option>
                        <option value="2">Little Miss</option>
                        <option value="3">Miss</option>
                        <option value="4">Trend</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <label for="couleur" class="input-group-text">Couleur</label>
                    <select name="idCouleur" id="couleur" class="nav-link dropdown-toggle" ">

                        <option value=" 4" style="background-color:#0000FF; color: white; ">Bleu</option>
                        <option value="2" style="background-color:#582900; color: white;">Marron</option>
                        <option value="3" style="background-color:#000000; color: white;">Noir</option>
                        <option value="1" style="background-color:#008000; color: white; ">Vert</option>
                        <option value="5" style="background-color:#606060; color: white;">Gris</option>
                        <option value="6" style="background-color:#ff7f00; color: white;">Orange</option>
                        <option value="7" style="background-color:#850606; color: white;">Rouge</option>
                        <option value="8" style="background-color:#7f00ff; color: white;">Violet</option>
                        <option value="9" style="background-color:#f8f8ff;">Blanc</option>
                        <option value="10" style="background-color:#ffe436;">Jaune</option>
                        <option value="11" style="background-color:#fd6c9e; color: white;">Rose</option>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <label for="taille" class="input-group-text">Taille</label>
                    <select name="idTaille" id="taille" class="nav-link dropdown-toggle">
                        <option value="1">S</option>
                        <option value="2">M</option>
                        <option value="3">L</option>
                        <option value="4">XL</option>
                    </select>
                </div>
                <div class="col-12 text-center mt-3">
                    <button type="submit" id="button" class="btn-lg mt-5"> Ajouter l'article</button>
                </div>

            </div>
        </div>

    </form>
</div>

<style>
    #button {
        background-color: #2274A5 !important;
        color: white;
        border: none;
        padding: 20px;
    }

    #taille,
    #couleur,
    #categorie {
        width: 200px;
        border-radius: 5px;
        border-color: #ced4da;
        text-align: center;
    }
</style>

<script>
    let icon = document.getElementById("icon");
    let photo = document.getElementById("photo");

    imageinput.onchange = evt => {
        const [file] = imageinput.files
        if (file) {
            icon.style.display = "none";
            photo.style.display = "block";
            image.src = URL.createObjectURL(file)
        }
    }
</script>