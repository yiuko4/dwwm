<div id="space"></div>
<footer id="sticky-footer" class="flex-shrink-0 bg-dark text-white-50">
    <div class="container text-center">
        <small>Copyright &copy; Antoine Cibick - 2022</small>
    </div>


</footer>


<style>
    #space {
        height: 80px;
    }

    footer {
        padding: 7px;
        position: absolute;
        bottom: 0;
        width: 100%;

    }


    /* MEDIA REPSONSIIVE */
    /* bureau */
    @media screen and (min-width: 768px) {
        #sticky-footer {
            display: block;
        }



    }

    /* tablette */
    @media screen and (min-width: 576px) and (max-width: 768px) {
        #sticky-footer {
            display: block;
        }


    }

    /* tel */
    @media screen and (max-width: 576px) {

        #sticky-footer {
            display: none;
        }


    }
</style>