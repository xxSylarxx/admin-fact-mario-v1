<?php

/*-------------------------
Autor: Developer Technology
Web: www.developer-technology.net
Mail: info@developer-technology.net
---------------------------*/

class SettingsController
{

    /*=============================================
    Mostrar datos de las configuraciones
    =============================================*/
    /* public static function settings()
    {

        $url = "configuraciones";
        $method = "GET";
        $fields = array();
        $token = TemplateController::tokenSet();

        $response = CurlController::requestSunat($url, $method, $fields, $token);

        if ($response->response->success == true) {

            $resultado = $response->response->data[0];

        } else {

            $resultado = "No encontrado";

        }

        return $resultado;

    } */
    public static function settings()
    {
        $url = "configuraciones";
        $method = "GET";
        $fields = array();
        $token = TemplateController::tokenSet();

        $response = CurlController::requestSunat($url, $method, $fields, $token);

        if (
            $response !== null &&
            isset($response->response) &&
            isset($response->response->success) &&
            $response->response->success == true
        ) {

            $resultado = $response->response->data[0];
        } else {

            $resultado = "No encontrado";
        }

        return $resultado;
    }
    // ajustes para prueba en servidor
    public static function getSafeSettings()
    {
        $settings = self::settings();

        // Si es string (error), retornar objeto por defecto
        if (is_string($settings)) {
            return (object)[
                'favicon_sistema_configuracion' => 'default.ico',
                'nombre_sistema_configuracion' => 'Sistema Facturación',
                'nombre_empresa_configuracion' => 'Mi Empresa',
                'descripcion_configuracion' => 'Sistema de facturación electrónica',
                'keywords_configuracion' => '[]',
                'web_empresa_configuracion' => 'https://miempresa.com',
            ];
        }

        // Si es objeto pero faltan propiedades, completar con valores por defecto
        return (object)array_merge([
            'favicon_sistema_configuracion' => 'default.ico',
            'nombre_sistema_configuracion' => 'Sistema Facturación',
            'nombre_empresa_configuracion' => 'Mi Empresa',
            'descripcion_configuracion' => 'Sistema de facturación electrónica',
            'keywords_configuracion' => '[]',
            'web_empresa_configuracion' => 'https://miempresa.com'
        ], (array)$settings);
    }

    /*=============================================
    Editar datos generales
    =============================================*/
    public function editGeneral()
    {

        if (isset($_POST["name-sys"])) {

            echo '<script>
                    matPreloader("on");
                    fncSweetAlert("loading", "Cargando...", "");
                </script>';

            $url = "configuraciones?id=1&nameId=id_configuracion&token=" . $_SESSION["user"]->token_usuario . "&table=usuarios&suffix=usuario";
            $method = "PUT";
            $fields = "nombre_sistema_configuracion=" . $_POST["name-sys"] . "&nombre_empresa_configuracion=" . $_POST["name-emp"] . "&descripcion_configuracion=" . TemplateController::htmlClean($_POST["description-emp"]) . "&web_empresa_configuracion=" . $_POST["web-emp"] . "&id_sunat_configuracion=" . $_POST["id-sunat"] . "&clave_sunat_configuracion=" . $_POST["clave-sunat"] . "&keywords_configuracion=" . json_encode(explode(",", $_POST["kw-emp"]));
            $token = TemplateController::tokenSet();

            $response = CurlController::requestSunat($url, $method, $fields, $token);

            if ($response->response->success == true) {

                echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "' . $response->response->data->comment . '", "/settings/general");
                    </script>';
            } else {

                echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncNotie(3, "Failed to edit registry");
                    </script>';
            }
        }
    }

    /*=============================================
    Editar servidor correo
    =============================================*/
    public function editServer()
    {

        if (isset($_POST["host-server"])) {

            echo '<script>
                    matPreloader("on");
                    fncSweetAlert("loading", "Cargando...", "");
                </script>';

            $url = "configuraciones?id=1&nameId=id_configuracion&token=" . $_SESSION["user"]->token_usuario . "&table=usuarios&suffix=usuario";
            $method = "PUT";
            $fields = "servidor_correo_configuracion=" . $_POST["host-server"] . "&usuario_correo_configuracion=" . $_POST["user-server"] . "&clave_correo_configuracion=" . $_POST["pass-server"] . "&puerto_correo_configuracion=" . $_POST["port-server"] . "&seguridad_correo_configuracion=" . $_POST["sec-server"];
            $token = TemplateController::tokenSet();

            $response = CurlController::requestSunat($url, $method, $fields, $token);

            if ($response->response->success == true) {

                echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "' . $response->response->data->comment . '", "/settings/server");
                    </script>';
            } else {

                echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncNotie(3, "Failed to edit registry");
                    </script>';
            }
        }
    }

    /*=============================================
    Editar Logo
    =============================================*/
    public function editLogo()
    {

        if (isset($_FILES["image-emp"]["tmp_name"])) {

            echo '<script>
					matPreloader("on");
					fncSweetAlert("loading", "Cargando...", "");
				</script>';

            $select = "id_configuracion,logo_sistema_configuracion";

            $url = "configuraciones?select=" . $select . "&linkTo=id_configuracion&equalTo=1";
            $method = "GET";
            $token = TemplateController::tokenSet();
            $fields = array();

            $response = CurlController::requestSunat($url, $method, $fields, $token);

            if ($response->response->success == true) {

                /*=============================================
                Validar cambio imagen
                =============================================*/
                if (isset($_FILES["image-emp"]["tmp_name"]) && !empty($_FILES["image-emp"]["tmp_name"])) {

                    /*=============================================
                    Borramos el archivo actual
                    =============================================*/
                    $urlDel = "file/delete";
                    $methodDel = "POST";
                    $fieldsDel = array(

                        "deleteUniqueFile" => $response->response->data[0]->logo_sistema_configuracion,
                        "deleteDir" => "img",
                        "deleteFol" => "logo",
                        "deleteCod" => "",

                    );
                    $dataFielDel = json_encode($fieldsDel);

                    $deletePicture = CurlController::requestSunat($urlDel, $methodDel, $dataFielDel, $token);

                    /*=============================================
                    Guardamos el archivo enviado
                    =============================================*/
                    $urlUp = "file/upload";
                    $methodUp = "POST";
                    $fieldsUp = array(

                        "file" => $_FILES["image-emp"]["tmp_name"],
                        "type" => $_FILES["image-emp"]["type"],
                        "mode" => "",
                        "folder" => "documents/img/logo",
                        "name" => base64_encode("logo_emp_" . time()),
                        "width" => 400,
                        "height" => 84,

                    );
                    $dataFielUp = json_encode($fieldsUp);

                    $saveImageEmpr = CurlController::requestSunat($urlUp, $methodUp, $dataFielUp, $token)->response->file;
                } else {

                    $saveImageEmpr = $response->response->data[0]->logo_sistema_configuracion;
                }

                /*=============================================
                Agrupamos la información
                =============================================*/
                $dataUp = "logo_sistema_configuracion=" . $saveImageEmpr;

                /*=============================================
                Solicitud a la API
                =============================================*/
                $url = "configuraciones?id=1&nameId=id_configuracion&token=" . $_SESSION["user"]->token_usuario . "&table=usuarios&suffix=usuario";
                $method = "PUT";
                $fields = $dataUp;

                $response = CurlController::requestSunat($url, $method, $fields, $token);

                /*=============================================
                Respuesta de la API
                =============================================*/
                if ($response->response->status == 200) {

                    echo '<script>
                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncSweetAlert("success", "' . $response->response->data->comment . '", "/settings/logo");
                        </script>';
                } else {

                    echo '<script>
                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncNotie(3, "Failed to edit registry");
                        </script>';
                }
            } else {

                echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncNotie(3, "Failed to edit registry");
                    </script>';
            }
        }
    }

    /*=============================================
    Editar Favicon
    =============================================*/
    public function editFavicon()
    {

        if (isset($_FILES["fav-emp"]["tmp_name"])) {

            echo '<script>
					matPreloader("on");
					fncSweetAlert("loading", "Cargando...", "");
				</script>';

            $select = "id_configuracion,favicon_sistema_configuracion";

            $url = "configuraciones?select=" . $select . "&linkTo=id_configuracion&equalTo=1";
            $method = "GET";
            $token = TemplateController::tokenSet();
            $fields = array();

            $response = CurlController::requestSunat($url, $method, $fields, $token);

            if ($response->response->success == true) {

                /*=============================================
                Validar cambio imagen
                =============================================*/
                if (isset($_FILES["fav-emp"]["tmp_name"]) && !empty($_FILES["fav-emp"]["tmp_name"])) {

                    /*=============================================
                    Borramos el archivo actual
                    =============================================*/
                    $urlDel = "file/delete";
                    $methodDel = "POST";
                    $fieldsDel = array(

                        "deleteUniqueFile" => $response->response->data[0]->favicon_sistema_configuracion,
                        "deleteDir" => "img",
                        "deleteFol" => "favicon",
                        "deleteCod" => "",

                    );
                    $dataFielDel = json_encode($fieldsDel);

                    $deletePicture = CurlController::requestSunat($urlDel, $methodDel, $dataFielDel, $token);

                    /*=============================================
                    Guardamos el archivo enviado
                    =============================================*/
                    $urlUp = "file/upload";
                    $methodUp = "POST";
                    $fieldsUp = array(

                        "file" => $_FILES["fav-emp"]["tmp_name"],
                        "type" => $_FILES["fav-emp"]["type"],
                        "mode" => "",
                        "folder" => "documents/img/favicon",
                        "name" => base64_encode("favicon_emp_" . time()),
                        "width" => 800,
                        "height" => 800,

                    );
                    $dataFielUp = json_encode($fieldsUp);

                    $saveImageEmpr = CurlController::requestSunat($urlUp, $methodUp, $dataFielUp, $token)->response->file;
                } else {

                    $saveImageEmpr = $response->response->data[0]->favicon_sistema_configuracion;
                }

                /*=============================================
                Agrupamos la información
                =============================================*/
                $dataUp = "favicon_sistema_configuracion=" . $saveImageEmpr;

                /*=============================================
                Solicitud a la API
                =============================================*/
                $url = "configuraciones?id=1&nameId=id_configuracion&token=" . $_SESSION["user"]->token_usuario . "&table=usuarios&suffix=usuario";
                $method = "PUT";
                $fields = $dataUp;

                $response = CurlController::requestSunat($url, $method, $fields, $token);

                /*=============================================
                Respuesta de la API
                =============================================*/
                if ($response->response->status == 200) {

                    echo '<script>
                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncSweetAlert("success", "' . $response->response->data->comment . '", "/settings/favicon");
                        </script>';
                } else {

                    echo '<script>
                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncNotie(3, "Failed to edit registry");
                        </script>';
                }
            } else {

                echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncNotie(3, "Failed to edit registry");
                    </script>';
            }
        }
    }

    /*=============================================
    Editar Pasarelas
    =============================================*/
    public function editGateway()
    {

        if (isset($_POST["client_id-paypal"])) {

            echo '<script>
                    matPreloader("on");
                    fncSweetAlert("loading", "Cargando...", "");
                </script>';

            $select = "*";

            $url = "configuraciones?select=" . $select . "&linkTo=id_configuracion&equalTo=1";
            $method = "GET";
            $fields = array();
            $token = TemplateController::tokenSet();

            $response = CurlController::requestSunat($url, $method, $fields, $token);

            if ($response->response->status == 200) {

                // Decodificar el JSON Paypal
                $jsonPaypal = $response->response->data[0]->paypal_configuracion;
                $datosPaypal = json_decode($jsonPaypal, true);

                // Acceder y editar los valores del arreglo
                $datosPaypal[0]['client_id'] = $_POST["client_id-paypal"];
                $datosPaypal[0]['secret_key'] = $_POST["secret_key-paypal"];

                // Codificar de nuevo el JSON
                $jsonPaypal = json_encode($datosPaypal);

                // Decodificar el JSON Culqi
                $jsonCulqi = $response->response->data[0]->culqi_configuracion;
                $datosCulqi = json_decode($jsonCulqi, true);

                // Acceder y editar los valores del arreglo
                $datosCulqi[0]['public_key'] = $_POST["public_key-culqi"];
                $datosCulqi[0]['secret_key'] = $_POST["secret_key-culqi"];

                // Codificar de nuevo el JSON
                $jsonCulqi = json_encode($datosCulqi);

                /*=============================================
                Solicitud a la API
                =============================================*/
                $url = "configuraciones?id=1&nameId=id_configuracion&token=" . $_SESSION["user"]->token_usuario . "&table=usuarios&suffix=usuario";
                $method = "PUT";
                $fields = "paypal_configuracion=" . $jsonPaypal . "&culqi_configuracion=" . $jsonCulqi;
                $token = TemplateController::tokenSet();

                $response = CurlController::requestSunat($url, $method, $fields, $token);

                if ($response->response->success == true) {

                    echo '<script>
                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncSweetAlert("success", "' . $response->response->data->comment . '", "/settings/gateway");
                        </script>';
                } else {

                    echo '<script>
                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncNotie(3, "Failed to edit registry");
                        </script>';
                }
            } else {

                echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncNotie(3, "Failed to edit registry");
                    </script>';
            }
        }
    }
}
