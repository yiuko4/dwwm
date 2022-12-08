<div id="container">
    <form method="POST" action="validation_creerCompte">


        <h1>Création de compte</h1>

        <div class="row">
            <!-- Prénom -->
            <div class="col">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <!-- Nom -->
            <div class="mb-2 col">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
        </div>


        <!-- Mail -->
        <div class="mb-2">
            <label for="mail" class="form-label">Mail</label>
            <input type="mail" class="form-control" id="mail" name="mail" required>
        </div>
        <!-- Téléphone -->
        <div class="mb-2">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="tel" class="form-control" id="telephone" name="telephone" required>

        </div>


        <div class="row">
            <!-- Mot de passe -->
            <div class="col">
                <label for="password" class="form-label">Mot de passe</label>
                <label for="password" id="passwordGhost">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <!-- Confirmer le mot de passe -->
            <div class="mb-5 col">
                <label for="confirm_password" class="form-label">Confirmer le mot de passe</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Créer votre compte</button>
        </div>
    </form>

</div>


<style>
    /* MEDIA REPSONSIIVE */
    /* bureau */
    @media screen and (min-width: 768px) {
        #container {

            width: 50%;
            margin-left: auto;
            margin-right: auto;

        }

    }

    /* tablette */
    @media screen and (min-width: 576px) and (max-width: 768px) {}

    /* tel */
    @media screen and (max-width: 576px) {
        #passwordGhost {
            color: white;
        }

        #container {


            margin: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px !important;
        }
    }

    h1 {
        text-align: center;
        margin-bottom: 40px;
    }
</style>