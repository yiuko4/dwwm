<div id="container">
    <div class="text-center mb-5">
        <h1>Profil de <?= $utilisateur['prenom'], " ", $utilisateur['nom'] ?></h1>
    </div>


    <!-- PRENOM NOM -->
    <div id="prenom" class="row mb-4">
        <div class="col-1"></div>
        <div class="col-8">
            <b> Prénom : </b> <?= $utilisateur['prenom'], " ", $utilisateur['nom'] ?>
        </div>
        <div class="col-1">
            <button class="btn btn-primary" id="btnModifPrenom">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                </svg>
            </button>
        </div>

    </div>



    <div id="modificationPrenom" class="d-none mb-4">
        <form method="POST" action="<?= URL; ?>compte/validation_modificationPrenom">
            <div class="row mb-4">
                <div class="col-1"></div>
                <div class="col-5" style="text-align: left;">
                    <b> Prénom</b>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-1"></div>
                <div class="col-7" style="text-align: left">
                    <input type="text" class="form-control" name="prenom" value="<?= $utilisateur['prenom'] ?>" />
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-1"></div>
                <div class="col-5" style="text-align: left;">
                    <b> Nom</b>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-1"></div>
                <div class="col-7" style="text-align: left;">
                    <input type="text" class="form-control" name="nom" value="<?= $utilisateur['nom'] ?>" />
                </div>

                <!-- bouton valide vert -->
                <div class="col-1">
                    <button class="btn btn-success" id="btnValidModifPrenom" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                        </svg>
                    </button>
                </div>

                <!-- bouton annuler rouge-->
                <div class="col-1">
                    <button class="btn btn-warning" id="btnAnnulModif" style="margin-left: 20px;" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                        </svg>
                    </button>
                </div>

            </div>
        </form>
    </div>




    <!-- MAIL -->
    <div id="mail" class="row mb-4">
        <div class="col-1"></div>
        <div class="col-8">
            <b> Mail : </b> <?= $utilisateur['mail'] ?>
        </div>
        <div class="col-1">
            <button class="btn btn-primary" id="btnModifMail">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                </svg>
            </button>
        </div>
        <div class="col-4"></div>
    </div>

    <div id="modificationMail" class="d-none mb-4">
        <form method="POST" action="<?= URL; ?>compte/validation_modificationMail">
            <div class="row mb-2">
                <div class="col-1"></div>
                <div class="col-4" style="text-align: left;">
                    <b> Mail</b>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-1"></div>
                <div class="col-7">
                    <input type="mail" class="form-control" name="mail" value="<?= $utilisateur['mail'] ?>" />
                </div>

                <div class="col-1">
                    <button class="btn btn-success" id="btnValidModifMail" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                        </svg>
                    </button>
                </div>

                <!-- bouton annuler rouge-->
                <div class="col-1">
                    <button class="btn btn-warning" id="btnAnnulModif" style="margin-left: 20px;" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </form>
    </div>


    <!-- TELEPHONE -->
    <div id="telephone" class="row mb-4">

        <div class="col-1"></div>
        <div class="col-8">
            <b> Téléphone : </b> <?= 0 . $utilisateur['telephone'] ?>
        </div>
        <div class="col-1">
            <button class="btn btn-primary" id="btnModifTelephone">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                </svg>
            </button>
        </div>

    </div>

    <div id="modificationTelephone" class="d-none mb-4">
        <form method="POST" action="<?= URL; ?>compte/validation_modificationTelephone">
            <div class="row mb-2">
                <div class="col-1"></div>
                <div class="col-1" style="text-align: left;">
                    <b> Téléphone</b>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-1"></div>
                <div class="col-7">
                    <input type="tel" class="form-control" name="telephone" value="<?= 0 . $utilisateur['telephone'] ?>" />
                </div>

                <div class="col-1">
                    <button class="btn btn-success" id="btnValidModifTelephone" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                        </svg>
                    </button>
                </div>

                <div class="col-1">
                    <button class="btn btn-warning" id="btnAnnulModif" style="margin-left: 20px;" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </form>
    </div>



    <!-- MOT DE PASSE -->
    <div id="password" class="row">
        <div class="col-1"></div>
        <div class="col-8" style="color:red">
            <b> Mot de passe :</b> ********
        </div>
        <div class="col-1">
            <button class="btn btn-primary " id="btnModifPassword">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                </svg>
            </button>
        </div>

    </div>

    <div id="modificationPassword" class="d-none">
        <form method="POST" action="<?= URL; ?>compte/validation_modificationPassword">
            <div class="row mb-2">
                <div class="col-1"></div>
                <div class="col-11" style="text-align: left;">
                    <b> Mot de passe actuel </b>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-1"></div>
                <div class="col-7" style="text-align: left;">
                    <input type="text" class="form-control" name="password" value="" />
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-1"></div>
                <div class="col-11" style="text-align: left;">
                    <b> Nouveau mot de passe </b>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-1"></div>
                <div class="col-7" style="text-align: left;">
                    <input type="text" class="form-control" name="password" value="" />
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-1"></div>
                <div class="col-11" style="text-align: left;">
                    <b> Confirmation du mot de passe</b>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-1"></div>
                <div class="col-7" style="text-align: left;">
                    <input type="text" class="form-control" name="confirmPassword" />
                </div>


                <!-- bouton valide vert -->
                <div class="col-1">
                    <button class="btn btn-success" id="btnValidModifPassword" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                        </svg>
                    </button>
                </div>
                <!-- bouton annule rouge -->
                <div class="col-1">
                    <button class="btn btn-warning" id="btnAnnulModif" style="margin-left: 20px;" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </form>
    </div>




    <!-- bouton retour rouge -->
    <div class="text-center mb-5">
        <div class="mb-2"></div>
        <form method="POST">
            <button class="btn btn-warning d-none" id="btnAnnulModif" class="col-3">
                <div>ANNULER</div>
            </button>
        </form>
    </div>





    <div class="text-center pt-50">
        <!-- <a href="<?= URL ?>compte/modificationPassword" class="btn btn-warning">Changer le mot de passe</a> -->
        <button id="btnSupCompte" class="btn btn-danger">Supprimer son compte</button>
    </div>


    <div id="suppressionCompte" class="d-none mt-5">
        <div class="alert alert-danger">
            Veuillez confirmer la suppression du compte.
            <br />
            <a href="<?= URL ?>compte/suppressionCompte" class="btn btn-danger">Je Souhaite supprimer mon compte définitivement !</a>
        </div>
    </div>

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
    @media screen and (min-width: 576px) and (max-width: 768px) {

    }

    /* tel */
    @media screen and (max-width: 576px) {
        
    }
</style>