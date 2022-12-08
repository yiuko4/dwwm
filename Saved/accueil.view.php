<div class="container">
    <div class="row mb-3">
        <?php
        $m = 0;
        $k = 0;
        foreach ($article as $Article) { ?>
            <div class="col-3" id="col">
                <form method="POST" action="login" class="mt-1" id="form">
                    <button id="article">
                        <input type="hidden" class="form-control" value="<?= $Article['id'] ?>" id="articleID" name="articleID">
                        <input type="hidden" class="form-control" value="<?= $Article['nom'] ?>" id="articleNOM" name="articleNOM">
                        <input type="hidden" class="form-control" value="<?= $Article['couleurID'] ?>" id="couleurID" name="couleurID">

                        <!-- image -->
                        <div id="text">
                            <img src="<?= URL; ?>public/Assets/images/article/<?= $Article['image'] ?>" alt="<?= $Article['image'] ?>">
                        </div>

                        <!-- nom -->
                        <div id="nom">
                            <?= $Article['nom']; ?>
                        </div>

                        <!-- couleur -->
                        <div class="row">

                            <?php for ($j = 0; $j < count($couleur[$m]); $j++) { ?>
                                <div id="couleur" style=" background-color: #<?= $couleur[$m][$j]['hexadecimal'] ?>; "> &nbsp; </div>
                            <?php } ?>
                        </div>

                        <!-- taille -->
                        <div id="taille">
                            <?php for ($j = 0; $j < count($taille[$m]); $j++) {
                                echo $taille[$m][$j]['taille'] . " ";
                            }
                            $m++; ?>
                        </div>

                        <!-- prix -->
                        <div id="prix">
                            <div class="row">
                                <?php if ((int)$Article['promotion'] != 0 &&  (int)$Article['promotion'] < (int)$Article['prix'] && (int)$Article['prix'] > 0) { ?>
                                    <div class="col-1 line" id="ancienPrix"><?= (int)$Article['prix']; ?>€ </div>
                                    <div class="col-1"><?= "&nbsp;&nbsp;" . (int)$Article['promotion']; ?>€ </div>
                                <?php } else { ?>
                                    <div class="col-1"><?= (int)$Article['prix']; ?>€ </div>
                                <?php } ?>
                            </div>
                        </div>
                    </button>
                </form>
            </div>
        <?php }   ?>
    </div>
</div>


<style>
    #col {
        margin-bottom: 50px;
    }

    #couleur {
        margin-left: 10px;
        width: 30px;
        height: 30px;
        border-radius: 20px;
        border: solid thin grey;
    }


    #nom {
        text-transform: uppercase;
        font-weight: bold;
    }

    #ancienPrix {
        text-decoration: line-through;
    }


    #article {
        text-align: left;
        text-decoration: none;
        border: none;
        background-color: white;
    }

    #article img {
        width: 100%;

    }


    #article:hover {
        background-color: rgb(244, 244, 244);
    }
</style>