<div id="container">
    <!-- LIVRAISON -->
    <div class="text-center ">
        <h2>Mode de livraison</h2>
    </div>
    <form>
        <label for="colissimo">Colissimo</label>
        <input type="checkbox" id="colissimo" name="modeLivraison" value="1" onclick="if(this.checked){checkColissimo()}" <?= ($livraison['Cdefaut'] == 1) ? "checked disabled" : ""; ?>>

        <label for="mondial_relay">Mondial Relay</label>
        <input type="checkbox" id="mondial_relay" name="modeLivraison" value="2" onclick="if(this.checked){CheckMondial_relay()}" <?= ($livraison['MRdefaut'] == 1) ? "checked disabled" : ""; ?>>

    </form>

    <div id="textColissimo" <?= ($livraison['Cdefaut'] == 1) ? "style=\"display:block\"" : "style=\"display:none\""; ?>><?php colissimo($livraison); ?></div>
    <div id="textMondial_relay" <?= ($livraison['MRdefaut'] == 1) ? "style=\"display:block\"" : "style=\"display:none\""; ?>><?php mondial_relay($livraison); ?></div>
</div>


<style>
    #btnEnvoyer {
        margin-top: 30px;
    }



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
        #mondial_relay {
            width: 50%;
            margin-left: auto;
            margin-right: auto;
        }
    }
</style>





<?php

/* FUNCTION */
function colissimo($livraison)
{ ?>
    <div class="starter-template">

        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger"><?= $error; ?></div>
        <?php endif; ?>

        <?php if (!empty($success)) : ?>
            <div class="alert alert-success"><?= $success; ?></div>
        <?php endif; ?>

        <form action="adresseColissimo" method="post">

            <div class="form-group">
                <label for="zipcode">Code Postal</label>
                <input type="text" name="zipcode" value="<?= $livraison['Ccode_postal'] ?>" class="form-control" id="zipcode">
                <div style="display: none; color: #f55;" id="error-message"></div>
            </div>

            <div class="form-group">
                <label for="city">Ville</label>
                <select class="form-control" value="<?= $livraison['Cville'] ?>" name="city" id="city">
                    <option value="<?= $livraison['Cville'] ?>"><?= $livraison['Cville'] ?></option>

                </select>
            </div>

            <div class="form-group">
                <label for="adresse">Adresse</label>
                <input type="text" name="adresse" value="<?= $livraison['Cadresse'] ?>" class="form-control" id="adresse">
                <div style="display: none; color: #f55;" id="error-message"></div>
            </div>

            <div class="form-group">
                <label for="lieu">Lieu-dit ou BP</label>
                <input type="text" name="lieu" value="<?= $livraison['Clieu_dit'] ?>" class="form-control" id="lieu">
                <div style="display: none; color: #f55;" id="error-message"></div>
            </div>

            <div class="form-group">
                <label for="batiment">Bâtiment, Immeuble</label>
                <input type="text" name="batiment" value="<?= $livraison['Cbatiment_immeuble'] ?>" class="form-control" id="batiment">
                <div style="display: none; color: #f55;" id="error-message"></div>
            </div>

            <div class="form-group">
                <label for="appartement">Appartement, Etage</label>
                <input type="text" name="appartement" value="<?= $livraison['Cappartement_etage'] ?>" class="form-control" id="appartement">
                <div style="display: none; color: #f55;" id="error-message"></div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary" id="btnEnvoyer">Envoyer</button>
            </div>
        </form>

    </div>





<?php }

?>
<script src="https://widget.mondialrelay.com/parcelshop-picker/jquery.plugin.mondialrelay.parcelshoppicker.min.js"></script>
<?php
function mondial_relay($livraison)
{ ?>

    <div id="Zone_Widget"></div>

    <div class="text-center">
        <form method="POST" action="adresseMondialRelay">
            <input type="hidden" name="enseigne" id="cb_Nom">
            <input type="hidden" name="adresse" id="cb_Adresse">
            <input type="hidden" name="cp" id="cb_CP">
            <input type="hidden" name="ville" id="cb_Ville">

            <button type="submit" class="btn btn-primary">Envoyer</button>

        </form>

    </div>

<?php
}
$variable = strtoupper($livraison['MRnom_enseigne']);

?>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet/dist/leaflet.css" />


<script src="https://widget.mondialrelay.com/parcelshop-picker/jquery.plugin.mondialrelay.parcelshoppicker.min.js"></script>

<script>
    function recupValeurs() {

        var cases = document.getElementsByName('modeLivraison');
        var resultat = "";
        for (var i = 0; i < cases.length; i++) {
            if (cases[i].checked) {
                resultat += cases[i].value;
            }
        }
        document.getElementById("livraisonValue").value = resultat;
    }

    //region colissimo
    function checkColissimo() {
        document.getElementById("mondial_relay").checked = false;
        document.getElementById("colissimo").disabled = true;
        document.getElementById("mondial_relay").disabled = false;

        if (document.getElementById("colissimo").checked == true) {
            document.getElementById("textColissimo").style.display = "block";
        }
        if (document.getElementById("mondial_relay").checked == false) {
            document.getElementById("textMondial_relay").style.display = "none";
        }
    }

    $(document).ready(function() {
        const apiUrl = 'https://geo.api.gouv.fr/communes?codePostal=';
        const format = '&format=json';

        let zipcode = $('#zipcode');
        let city = $('#city');
        let errorMessage = $('#error-message');

        $(zipcode).on('blur', function() {
            let code = $(this).val();
            //console.log(code);
            let url = apiUrl + code + format;
            //console.log(url);

            fetch(url, {
                method: 'get'
            }).then(response => response.json()).then(results => {
                //console.log(results);
                $(city).find('option').remove();
                if (results.length) {
                    $(errorMessage).text('').hide();
                    $.each(results, function(key, value) {
                        //console.log(value);
                        console.log(value.nom);
                        $(city).append('<option value="' + value.nom + '">' + value.nom + '</option>');
                    });
                } else {
                    if ($(zipcode).val()) {
                        console.log('Erreur de code postal.');
                        $(errorMessage).text('Aucune commmune avec ce code postal.').show();
                    } else {
                        $(errorMessage).text('').hide();
                    }
                }
            }).catch(err => {
                console.log(err);
                $(city).find('option').remove();
            });
        });
    });




    //endregion

    //region mondial relay
    function CheckMondial_relay() {
        document.getElementById("colissimo").checked = false;
        document.getElementById("mondial_relay").disabled = true;
        document.getElementById("colissimo").disabled = false;
        if (document.getElementById("mondial_relay").checked == true) {
            document.getElementById("textMondial_relay").style.display = "block";
        }
        if (document.getElementById("colissimo").checked == false) {
            document.getElementById("textColissimo").style.display = "none";
        }
    }

    /* Afficher les valeurs dans l'API mondial relay */
    window.onload = function setMondialRelay() {
        /* on ajoute un id a la class */
        /* var variable = "INTERMARCHE"; */
        var variable = <?php echo json_encode($variable); ?>;

        var elements = document.getElementsByClassName("PR-List-Item");
        for (let n = 0; n < 7; n++) {

            elements[n].setAttribute("id", "test" + n);

            var element = document.getElementById("test" + n);
            const enseigne = element.innerText;

            /* nom de l'enseigne bdd */
            const nom = variable.split(' ').join(',').split(' ').join(',').split('-').join(',').split(',');

            /* nom de l'enseigne mondial relay */
            const words = enseigne.split('\n').join(',').split(' ').join(',').split('-').join(',').split(',');
            for (let i = 0; i <= words.length; i++) {
                console.log(nom);
                for (let j = 0; j <= nom.length; j++) {
                    if (words[i] == nom[j] && words[i] != undefined) {

                        MR_jQuery("#Zone_Widget").trigger("FocusOnMap", n);
                        return;
                    }
                }
            }
        }
    }

    /* API mondial relay */
    $(document).ready(function() {
        // Charge le widget dans la DIV d'id "Zone_Widget" avec les paramètres indiqués
        $("#Zone_Widget").MR_ParcelShopPicker({
            Responsive: true,
            //
            // Paramétrage de la liaison avec la page.
            //
            // Selecteur de l'élément dans lequel est envoyé l'ID du Point Relais (ex: input hidden)
            Target: "#Target_Widget",
            // Selecteur de l'élément dans lequel est envoyé l'ID du Point Relais pour affichage
            TargetDisplay: "#TargetDisplay_Widget",
            // Selecteur de l'élément dans lequel sont envoysé les coordonnées complètes du point relais
            TargetDisplayInfoPR: "#TargetDisplayInfoPR_Widget",
            //
            // Paramétrage du widget pour obtention des point relais.
            //
            // Le code client Mondial Relay, sur 8 caractères (ajouter des espaces à droite)
            // BDTEST est utilisé pour les tests => un message d'avertissement apparaît
            /*             City: "Cercy-La-Tour",
             */
            Brand: "BDTEST  ",
            // Pays utilisé pour la recherche: code ISO 2 lettres.
            Country: "FR",
            // Code postal pour lancer une recherche par défaut
            PostCode: "58340",
            EnableGeolocalisatedSearch: "true",
            // Mode de livraison (Standard [24R], XL [24L], XXL [24X], Drive [DRI])
            ColLivMod: "24R",
            // Nombre de Point Relais à afficher
            NbResults: "7",
            //
            // Paramétrage d'affichage du widget.
            //
            // Afficher les résultats sur une carte?
            ShowResultsOnMap: true,
            // Afficher les informations du point relais à la sélection sur la carte?
            DisplayMapInfo: true,
            // Fonction de callback déclenché lors de la selection d'un Point Relais
            OnParcelShopSelected:
                // Fonction de traitement à la sélection du point relais.
                // Remplace les données de cette page par le contenu de la variable data.
                // data: les informations du Point Relais
                function(data) {

                    var nom = data.Nom;
                    var adresse = data.Adresse1 + ' ' + data.Adresse2;
                    var cp = data.CP;
                    var ville = data.Ville;


                    document.getElementById("cb_Nom").value = nom;
                    document.getElementById("cb_Adresse").value = adresse;
                    document.getElementById("cb_CP").value = cp;
                    document.getElementById("cb_Ville").value = ville;


                }


            //
            // Autres paramétrages.
            //
            // Filtrer les Points Relais selon le Poids (en grammes) du colis à livrer
            // Weight: "",
            // Spécifier le nombre de jours entre la recherche et la dépose du colis dans notre réseau
            // SearchDelay: "3",
            // Limiter la recherche des Points Relais à une distance maximum
            // SearchFar: "",										
            // Liste des pays selectionnable par l'utilisateur pour la recherche: codes ISO 2 lettres
            // AllowedCountries: "FR,ES",
            // Force l'utilisation de Google Map si la librairie est présente? 
            // EnableGmap: true,                  
            // Activer la recherche de la position lorsque le navigateur de l'utilisateur le supporte?
            // EnableGeolocalisatedSearch: "true",
            // Spécifier l'utilisation de votre feuille de style CSS lorsque vous lui donnez la valeur "0"
            // CSS: "1",
            // Activer le zoom on scroll sur la carte des résultats?
            //,MapScrollWheel: "false",
            // Activer le mode Street View sur la carte des résultats (attention aux quotas imposés par Google)
            // MapStreetView: "false"
        });

    });

    //endregion
</script>