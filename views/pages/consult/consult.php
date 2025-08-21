<?php

if(isset($routesArray[2])){

    if($routesArray[2] == "ruc"){

        $nameBread = 'Consulta RUC';

    } elseif($routesArray[2] == "dni") {

        $nameBread = 'Consulta DNI';

    } elseif($routesArray[2] == "cpe") {

        $nameBread = 'Consulta CPE';

    } elseif($routesArray[2] == "exchange") {

        $nameBread = 'Consulta Tipo Cambio';

    } else {
        
        $nameBread = '----';

    }

} else {

    $nameBread = '----';

}

?>

<div class="content__header content__boxed overlapping">

    <div class="content__wrap">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">

                <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                <li class="breadcrumb-item">Consultas</li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $nameBread ?></li>

            </ol>
        </nav>
        <!-- END : Breadcrumb -->

        <h1 class="page-title mb-0 mt-2">
            <?php echo $nameBread ?>
            <button class="btn btn-default border" data-toggle="modal" data-target="#viewToken" style="position: absolute; right: 20px; top: 12%;"><i class="fa fa-eye"></i> <span class="vr"></span> Mis Credenciales</button>
        </h1>

        <p class="lead"></p>

    </div>

</div>

<div class="content__boxed">

    <div class="content__wrap">

        <?php 

            if(isset($routesArray[2])){

                if($routesArray[2] == "ruc" ||
                    $routesArray[2] == "dni" ||
                    $routesArray[2] == "exchange" ||
                    $routesArray[2] == "cpe"
                ){

                    include $routesArray[2]."/".$routesArray[2].".php";

                } else {

                    echo '<script>
                        window.location = "/consult/ruc";
                    </script>'; 

                }

            }else{

                echo '<script>
                        window.location = "/consult/ruc";
                    </script>'; 

            }

        ?>

    </div>
    
</div>