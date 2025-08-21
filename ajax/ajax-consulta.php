<?php

/*-------------------------
Autor: Developer Technology
Web: www.developer-technology.net
Mail: info@developer-technology.net
---------------------------*/

/*=============================================
Iniciamos la sesion
=============================================*/
session_start();

/*=============================================
Requerimos los controladores
=============================================*/
require_once "../controllers/template.controller.php";
require_once "../controllers/curl.controller.php";

/*=============================================
Obtenemos los datos de la empresa
=============================================*/
require_once "../controllers/tenants.controller.php";

/*=============================================
Obtenemos el token de la empresa
=============================================*/
if($_SESSION["empresa"] != '') {

    $value = $_SESSION["empresa"]->id_empresa;

    $dataTenants = TenantsController::dataTenant($value);

    $token = $dataTenants->token_empresa;

    $data = array(
        "claveSecreta" => $dataTenants->clave_secreta_empresa
    );

    $fields = json_encode($data);

} else {

    /*=============================================
    Si no hay sesion de la empresa se toma el token admin
    =============================================*/
    $token = 'e0562bc98c5c88dbc900f117ecf863b0b7e9ba7ab2747fd42c855cfbc5d915b1';

    $data = array(
        "claveSecreta" => "d3h-1av-a9q-qta-crf-44d"
    );

    $fields = json_encode($data);

}

/*=============================================
Consulta CPE
=============================================*/
if($_POST['type'] == 'cpe') {

    $url = "consult";
    $data = array(
        "comprobante" => array(
            "rucEmisor" => $_POST["rucEmisor"],
            "codComp" => $_POST["typeComp"],
            "serie" => $_POST["serieComp"],
            "numero" => $_POST["numberComp"],
            "fechaEmision" => date('d/m/Y', strtotime($_POST["fechaEmision"])),
            "monto" => $_POST["montoComp"]
        ),
        "claveSecreta" => $dataTenants->clave_secreta_empresa
    );

    $fields = json_encode($data);
    
} else if($_POST['type'] == 'tc') {

    /*=============================================
    Consulta Tipo de cambio
    =============================================*/
    $url = "consult/exchange";

} else {

    /*=============================================
    Consulta RUC / DNI
    =============================================*/
    $url = "consult/" . $_POST['type'] . '/' . $_POST['doc'];

}

/*=============================================
Establecemos el metodo
=============================================*/
$method = "POST";

/*=============================================
Ejecutamos la funcion
=============================================*/
$objConsult = CurlController::requestSunat($url, $method, $fields, $token);

/*=============================================
Mostramos los resultados
=============================================*/
echo json_encode($objConsult);