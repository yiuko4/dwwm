  <div class="header" id="myHeader">
    <header class="d-flex flex-wrap justify-content-center  mb-4">
      <a id="texte" href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto  text-decoration-none">
        <!--<img src="<?= URL; ?>public/Assets/images/logo.png" width="40" alt="logo du site" />-->
        <span class="ms-5 fs-4">Flo & les tortues</span>
      </a>

      <?php require_once("views/common/menu.php"); ?>
    </header>
  </div>


  <div id="mobile">
    <div class="space">&nbsp</div>
    <?php require_once("views/common/menu_mobile.php"); ?>
  </div>


  <style>
    #space {
      height: 80px;
    }

    /* MEDIA REPSONSIIVE */
    /* bureau */
    @media screen and (min-width: 768px) {
      #myHeader {
        display: block;
      }

      #mobile {
        display: none;
      }

    }

    /* tablette */
    @media screen and (min-width: 576px) and (max-width: 768px) {
      #myHeader {
        display: block;
      }

      #mobile {
        display: none;
      }
    }

    /* tel */
    @media screen and (max-width: 576px) {

      #myHeader {
        display: none;
      }

      #mobile {
        display: block;
      }

    }
  </style>