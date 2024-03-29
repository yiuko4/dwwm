<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <!-- si l'utilisateur n'est pas connecte -->
        <?php if (!Securite::estConnecte()) : ?>
          <li class="nav-item">
            <a id="texte" class="nav-link" aria-current="page" href="<?= URL; ?>accueil">Accueil</a>
          </li>
          <li class="nav-item">
            <a id="texte" class="nav-link" aria-current="page" href="<?= URL; ?>login">Se connecter</a>
          </li>
          <li class="nav-item">
            <a id="texte" class="nav-link" aria-current="page" href="<?= URL; ?>creerCompte">Créer compte</a>
          </li>
        <?php else : ?>
          <!-- si l'utilisateur est connecte -->
          <li class="nav-item">
            <a id="texte" class="nav-link" aria-current="page" href="<?= URL; ?>boutique/accueil">Accueil</a>
          </li>
          <li class="nav-item">
            <a id="texte" class="nav-link" aria-current="page" href="<?= URL; ?>boutique/panier">Panier</a>
          </li>

          <!-- compte/profil compte/livraison -->
          <li class="nav-item dropdown">
            <a id="texte" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Profil
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a id="texte" class="dropdown-item" href="<?= URL; ?>compte/profil"> Compte </a></li>
              <li><a id="texte" class="dropdown-item" href="<?= URL; ?>compte/livraison"> Livraison </a></li>
            </ul>
          </li>


          </li>
          <li class="nav-item">
            <a id="texte" class="nav-link" aria-current="page" href="<?= URL; ?>compte/deconnexion">Se déconnecter</a>
          </li>
        <?php endif; ?>
        <!-- si l'administrateur est connecte -->
        <?php if (Securite::estConnecte() && Securite::estAdministrateur()) : ?>
          <li class="nav-item dropdown">
            <a id="texte" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Administration
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a id="texte" class="dropdown-item" href="<?= URL; ?>administration/articles">Gestion articles </a></li>
              <li><a id="texte" class="dropdown-item" href="<?= URL; ?>administration/formulaireAjoutArticle">Ajouter un article </a></li>
              
            </ul>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>


<style>

#texte{
  color:black;
}

</style>

