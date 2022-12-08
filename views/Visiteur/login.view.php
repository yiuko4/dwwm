<div id="container">
    <h1>Page de connexion</h1>
    <form method="POST" action="<?= URL ?>validation_login">

        <!-- Mail -->
        <div class="row">
            <div class="col-1"> </div>
            <div class="col-7">
                <label for="mail" class="form-label">Adresse Mail</label>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-1"> </div>
            <div class="col-10">
                <input type="mail" class="form-control" id="mail" name="mail" required>
            </div>
        </div>

        <!-- Password -->
        <div class="row">
            <div class="col-1"> </div>
            <div class="col-7">
                <label for="password" class="form-label">Password</label>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-1"> </div>
            <div class="col-10">
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
        </div>

        <!-- Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Connexion</button>

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