<?php

/*-------------------------
Autor: Developer Technology
Web: www.developer-technology.net
Mail: info@developer-technology.net
---------------------------*/

/*=============================================
Mostrar errores
=============================================*/
ini_set('display_errors', 1);
ini_set("log_errors", 1);
// ini_set("error_log", "D:/xamppNew/htdocs/scriptApi/php_error_log"); // Solo local
ini_set("error_log", "php_error_log"); // Para servidor

/*=============================================
CORS
=============================================*/
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: POST');

/*=============================================
Controladores
=============================================*/
require_once "controllers/curl.controller.php";
require_once "controllers/template.controller.php";

$index = new TemplateController();
$index->index();