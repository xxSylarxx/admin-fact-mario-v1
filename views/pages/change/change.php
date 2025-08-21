<?php

/*-------------------------
Autor: Developer Technology
Web: www.developer-technology.net
Mail: info@developer-technology.net
---------------------------*/

/*=============================================
Dejamos en blanco la sesion de la empresa
=============================================*/
$_SESSION['empresa'] = "";
$_SESSION['admin'] = "";

/*=============================================
Redireccionamos
=============================================*/
echo '<script>
        fncFormatInputs();
        window.location = "/"
    </script>';