<div class="container">


    <div id="profil" class="col-8">
        <a id="a" type="button" href="<?= URL; ?>compte/profil">Profil</a>
    </div>
    <div id="livraison" class="col-8">
        <a id="a" type="button" href="<?= URL; ?>compte/livraison">Livraison</a>
    </div>
    <div id="commande" class="col-8">
        <a id="a" type="button" href="<?= URL; ?>compte/commande">Commande</a>
    </div>
    <div id="deconnexion" class="col-6">
        <a id="a" type="button" href="<?= URL; ?>compte/deconnexion">Déconnexion</a>
    </div>

</div>

<style>
    #a{
        text-decoration: none;
        color: white;

    }
    #profil {
     
        background-color: #2274a5;
        border-radius: 10px;
        padding: 10px;
        text-align: center;
        font-size: 2em ;
        margin-right: auto;
        margin-left: auto;
        margin-top: 50px;
    }

    #livraison {
        background-color: #2274a5;
        border-radius: 10px;
        padding: 10px;
        text-align: center;
        font-size: 2em ;
        margin-right: auto;
        margin-left: auto;
        margin-top: 50px;
    }

    #commande {
     
     background-color: #2274a5;
     border-radius: 10px;
     padding: 10px;
     text-align: center;
     font-size: 2em ;
     margin-right: auto;
     margin-left: auto;
     margin-top: 50px;
 }


    #deconnexion {
        background-color: #bb2d3b;
        border-radius: 10px;
        padding: 10px;
        text-align: center;
        font-size: 1.5em ;
        margin-top: 150px;
        margin-right: auto;
        margin-left: auto;
        
    }
</style>