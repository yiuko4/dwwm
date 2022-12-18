<div class="container">

    <div class="text-center mb-4">
        <h2>Information personelle</h2>
    </div>

    <!-- INFORMATION PERSONELLE -->
    <b> Nom Prénom : </b> <?= $utilisateur[0]['nom'], " ", $utilisateur[0]['prenom'] ?><br>
    <b> Téléphone : </b> 0<?= $utilisateur[0]['telephone'] ?>

    <form method="POST" action="<?= URL ?>compte/profil">
        <input type="submit" class="btn btn-primary" value="Modifier">
    </form>

    <!-- LIVRAISON -->
    <div class="text-center ">
        <h2>Mode de livraison</h2>
    </div>

    <form>
        <label for="colissimo">Colissimo</label>
        <input type="checkbox" id="colissimo" name="modeLivraison" value="1" onclick="if(this.checked){checkColissimo()}" <?= ($utilisateur[0]['Cdefaut'] == 1) ? "checked disabled" : ""; ?>>

        <label for="mondial_relay">Mondial Relay</label>
        <input type="checkbox" id="mondial_relay" name="modeLivraison" value="2" onclick="if(this.checked){CheckMondial_relay()}" <?= ($utilisateur[0]['MRdefaut'] == 1) ? "checked disabled" : ""; ?>>

    </form>

    <div id="textColissimo" <?= ($utilisateur[0]['Cdefaut'] == 1) ? "style=\"display:block\"" : "style=\"display:none\""; ?>><?php colissimo($utilisateur); ?></div>
    <div id="textMondial_relay" <?= ($utilisateur[0]['MRdefaut'] == 1) ? "style=\"display:block\"" : "style=\"display:none\""; ?>><?php mondial_relay($utilisateur); ?></div>


    <form method="POST" action="<?= URL ?>compte/livraison">

        <input type="submit" class="btn btn-primary" value="Modifier">
    </form>

    <!-- LIVRAISON -->
    <?php panier($panier); ?>



    <!-- VALIDER LA COMMANDE -->
    <div class="text-center">
        <!-- si livraisonValue = 1 alors c'est un colissimo, si 2 c'est un mondial relay -->
        <input type="hidden" id="livraisonValue" name="livraisonValue">
        <input type="hidden" value="" name="">
        <!--     <button onclick="recupValeurs()" > Passer la commande et payer </button>
 -->
    </div>

</div>






<?php

/* FUNCTION */
function colissimo($utilisateur)
{ ?>
    <b> COLISSIMO</b><br>
    <b> Code postal : </b> <?= $utilisateur[0]['Ccode_postal'] ?> <br>
    <b> Ville : </b> <?= $utilisateur[0]['Cville'] ?><br>
    <b> Adresse : </b> <?= $utilisateur[0]['Cadresse'] ?><br>

    <?php
    if ($utilisateur[0]['Clieu_dit'] != NULL) {  ?>
        <b> Lieu dit : </b> <?= $utilisateur[0]['Clieu_dit'] ?><br>
    <?php }
    if ($utilisateur[0]['Cbatiment_immeuble'] != NULL) {  ?>
        <b> Batiment Immeuble : </b> <?= $utilisateur[0]['Cbatiment_immeuble'] ?><br>
    <?php }
    if ($utilisateur[0]['Cappartement_etage'] != NULL) {  ?>
        <b> Appartement Etage : </b> <?= $utilisateur[0]['Cappartement_etage'] ?><br>
    <?php }
    ?>
<?php }


function mondial_relay($utilisateur)
{ ?>
    <b> MONDIAL RELAY</b><br>
    <b> Enseigne: </b> <?= $utilisateur[0]['MRnom_enseigne'] ?> <br>
    <b> Code postal: </b> <?= $utilisateur[0]['MRcode_postal'] ?><br>
    <b> Ville: </b> <?= $utilisateur[0]['MRville'] ?><br>
    <b> Adresse: </b> <?= $utilisateur[0]['MRadresse'] ?><br>
<?php
}

function panier($panier)
{ ?>

    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Nom</th>
                <th>Couleur</th>
                <th>Taille</th>
                <th>Prix</th>

            </tr>
            <?php foreach ($panier as $Panier) : ?>
                <tr>
                    <td> <img src="<?= URL; ?>public/Assets/images/article/<?= $Panier['image'] ?>" width="100px" alt="<?= $Panier['image'] ?>"></td>

                    <td><?= $Panier['nom']; ?></td>
                    <td><?= $Panier['couleur']; ?></td>
                    <td><?= $Panier['taille']; ?></td>
                    <td>
                        <div class="row">
                            <?php if ((int)$Panier['promotion'] != 0 &&  (int)$Panier['promotion'] < (int)$Panier['prix'] && (int)$Panier['prix'] > 0) { ?>
                                <div class="col-1 line" id="ancienPrix"><?= (int)$Panier['prix']; ?>€ </div>
                                <div class="col-1"><?= "&nbsp;&nbsp;" . (int)$Panier['promotion']; ?>€ </div>

                            <?php } else { ?>
                                <div class="col-1"><?= (int)$Panier['prix']; ?>€ </div>
                            <?php } ?>

                        </div>
                    </td>

                </tr>

            <?php endforeach; ?>

    </table>

    <form action="./checkout-session" method="POST">
        <button type="submit" class="btn btn-primary" id="checkout-button">Checkout</button>
    </form>

<?php }

?>


<script>
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

    function recupValeurs() {
        var cases = document.getElementsByName('modeLivraison');
        var resultat = "";
        for (var i = 0; i < cases.length; i++) {
            if (cases[i].checked == true) {
                resultat += cases[i].value;
            }
        }
        document.getElementById("livraisonValue").value = resultat;
    }
</script>

<style>
    #ancienPrix {
        text-decoration: line-through;
    }
</style>