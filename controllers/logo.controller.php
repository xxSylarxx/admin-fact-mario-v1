<?php

/*-------------------------
Autor: Developer Technology
Web: www.developer-technology.net
Mail: info@developer-technology.net
---------------------------*/

class LogoController
{

    /*=============================================
    Cargar logo
    =============================================*/
    public function logo($ruc)
    {

        if (isset($_POST["ruc-tenant"])) {

            /*=============================================
            Mensaje de carga
            =============================================*/
            echo '<script>
                    matPreloader("on");
                    fncSweetAlert("loading", "Cargando...", "");
                </script>';

            if($_POST["ruc-tenant"] == $ruc) {

                /*=============================================
                Validar la carga del logo
                =============================================*/
                if (isset($_FILES["file-logo"]["tmp_name"]) && !empty($_FILES["file-logo"]["tmp_name"])) {

                    /*=============================================
                    Recogemos los datos
                    =============================================*/
                    $url = "logo";
                    $method = "POST";
                    $token = $_SESSION["empresa"]->token_empresa;

                    $fields = array(

                        "claveSecreta" => $_SESSION["empresa"]->clave_secreta_empresa,
                        "file" => $_FILES["file-logo"]["tmp_name"],
                        "type" => $_FILES["file-logo"]["type"],
                        "width" => 400,
                        "height" => 84
                        
                    );

                    $data = json_encode($fields);

                    $saveLogo = CurlController::requestSunat($url, $method, $data, $token);

                    /*=============================================
                    Respuesta de la API
                    =============================================*/
                    if ($saveLogo->response->success == true) {

                        echo '<script>
								fncFormatInputs();
								matPreloader("off");
								fncSweetAlert("close", "", "");
								fncSweetAlert("success", "' . $saveLogo->response->message . '", "/businesses/logo");
							</script>';

                    } else {

                        echo '<script>
                                fncFormatInputs();
                                matPreloader("off");
                                fncSweetAlert("close", "", "");
                                fncNotie(3, "' . $saveLogo->response->message . '");
                            </script>';

                    }

                } else {

                    echo '<script>
                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncNotie(3, "Debes seleccionar un archivo");
                        </script>';

                }

            }

        }

    }

}