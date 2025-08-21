<?php

/*-------------------------
Autor: Developer Technology
Web: www.developer-technology.net
Mail: info@developer-technology.net
---------------------------*/

class TenantsController
{

    /*=============================================
    Mostrar datos
    =============================================*/
    public static function dataTenant($value)
    {

        $url = "empresas?select=*&linkTo=id_empresa&equalTo=" . $value;
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

    }

    /*=============================================
    Listar datos
    =============================================*/
    public static function ctrListTenants()
    {

        $url = "empresas";
        $method = "GET";
        $fields = array();
        $token = TemplateController::tokenSet();

        $response = CurlController::requestSunat($url, $method, $fields, $token);

        if ($response->response->success == true) {

            $resultado = $response->response->data;

        } else {

            $resultado = "No encontrado";

        }

        return $resultado;

    }

    /*=============================================
    Crear empresa
    =============================================*/
    public function create($idTenants, $plan, $idPlan)
    {

        if (isset($_POST['ruc-tenant'])) {

            echo '<script>
                    matPreloader("on");
                    fncSweetAlert("loading", "Cargando...", "");
                </script>';

            /*=============================================
            Creamos el token unico
            =============================================*/
            $token = bin2hex(random_bytes(32));

            /*=============================================
            Creamos la clave secreta
            =============================================*/
            $secretKey = TemplateController::secretKey($_POST["ruc-tenant"]);

            $url = "empresas?token=" . $_SESSION["user"]->token_usuario . "&table=usuarios&suffix=usuario";
            $method = "POST";
            $fields = array(
                "ruc_empresa" => $_POST["ruc-tenant"],
                "razon_social_empresa" => $_POST["name-tenant"],
                "nombre_comercial_empresa" => $_POST["nc-tenant"],
                "telefono_empresa" => $_POST["phone-tenant"],
                "email_empresa" => $_POST["email-tenant"],
                "id_plan_empresa" => $plan,
                "direccion_empresa" => $_POST["address-tenant"],
                "departamento_empresa" => $_POST["dep-tenant"],
                "provincia_empresa" => $_POST["pro-tenant"],
                "distrito_empresa" => $_POST["dis-tenant"],
                "ubigeo_empresa" => $_POST["ubi-tenant"],
                "fase_empresa" => 'beta',
                "usuario_sol_empresa" => 'MODDATOS',
                "clave_sol_empresa" => 'moddatos',
                "estado_empresa" => 1,
                "token_empresa" => $token,
                "clave_secreta_empresa" => $secretKey,
                "creado_empresa" => date('Y-m-d'),
            );
            $token = TemplateController::tokenSet();

            $response = CurlController::requestSunat($url, $method, $fields, $token);

            if ($response->response->success == true) {

                /*=============================================
                Actualizamos el usuario con la empresa
                =============================================*/
                $dataArray = $idTenants;

                if ($dataArray != null) {

                    $arr = json_decode($dataArray, true);
                    array_push($arr, array("id" => $response->response->data->lastId));
                    $tenants = json_encode($arr);

                } else {

                    $json[] = ['id' => $response->response->data->lastId];
                    $tenants = json_encode($json);

                }

                $urlUp = 'usuarios?id=' . $_SESSION["user"]->id_usuario . '&nameId=id_usuario&token=' . $_SESSION["user"]->token_usuario . '&table=usuarios&suffix=usuario';
                $methodUp = "PUT";
                $fieldsUp = "id_empresa_usuario=" . $tenants;

                $responseU = CurlController::requestSunat($urlUp, $methodUp, $fieldsUp, $token);

                /*=============================================
                Actualizamos la venta con la empresa
                =============================================*/
                $urlSale = 'ventas?id=' . $idPlan . '&nameId=trans_venta&token=' . $_SESSION["user"]->token_usuario . '&table=usuarios&suffix=usuario';
                $methodSale = "PUT";
                $fieldsSale = "id_empresa_venta=" . $response->response->data->lastId;

                $responseSale = CurlController::requestSunat($urlSale, $methodSale, $fieldsSale, $token);

                /*=============================================
                Actualizamos la fecha proxima de facturacion
                =============================================*/
                $fechaActual = date('Y-m-d'); // Obtener la fecha actual en formato 'YYYY-MM-DD'
                $fechaNueva = date('Y-m-d', strtotime('+1 month', strtotime($fechaActual))); // Aumentar un mes a la fecha actual
                $urlPf = 'empresas?id=' . $response->response->data->lastId . '&nameId=id_empresa&token=' . $_SESSION["user"]->token_usuario . '&table=usuarios&suffix=usuario';
                $methodPf = "PUT";
                $fieldsPf = "proxima_facturacion_empresa=" . $fechaNueva;

                $responseSale = CurlController::requestSunat($urlPf, $methodPf, $fieldsPf, $token);

                echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "' . $response->response->data->comment . '", "/");
                    </script>';

            } else {

                echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncNotie(3, "Failed to save record");
                    </script>';

            }

        }

    }

    /*=============================================
    Actualizar logo
    =============================================*/
    public static function updateLogo($data)
    {

        $table = "empresas";

        $response = TenantsModel::updateLogo($table, $data);

        return $response;

    }

    /*=============================================
    Actualizar certificado
    =============================================*/
    public static function updateCertificate($data)
    {

        $table = "empresas";

        $response = TenantsModel::updateCertificate($table, $data);

        return $response;

    }

    /*=============================================
    Actualizar datos
    =============================================*/
    public static function updateTenant($id)
    {

        if (isset($_POST["id-tenant"])) {

            /*=============================================
            Mensaje de carga
            =============================================*/
            echo '<script>
                    matPreloader("on");
                    fncSweetAlert("loading", "Cargando...", "");
                </script>';

            /*=============================================
            Validamos la sintaxis del correo
            =============================================*/
            if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["mail-tenant"])) {

                if ($_POST["id-tenant"] == $id) {

                    $select = "*";

                    $url = "empresas?select=" . $select . "&linkTo=id_empresa&equalTo=" . $id;
                    $method = "GET";
                    $fields = array();
                    $token = TemplateController::tokenSet();

                    $response = CurlController::requestSunat($url, $method, $fields, $token);

                    if ($response->response->success == true) {

                        $data = "nombre_comercial_empresa=" . $_POST["nc-tenant"] . "&telefono_empresa=" . $_POST["phone-tenant"] . "&email_empresa=" . $_POST["mail-tenant"] . "&direccion_empresa=" . $_POST["address-tenant"] . "&departamento_empresa=" . $_POST["dep-tenant"] . "&provincia_empresa=" . $_POST["pro-tenant"] . "&distrito_empresa=" . $_POST["dis-tenant"] . "&ubigeo_empresa=" . $_POST["ubi-tenant"];

                        $url = "empresas?id=" . $id . "&nameId=id_empresa&token=" . $_SESSION["user"]->token_usuario . "&table=usuarios&suffix=usuario";
                        $method = "PUT";
                        $fields = $data;

                        $response = CurlController::requestSunat($url, $method, $fields, $token);

                        if ($response->response->success == true) {

                            echo '<script>
                                    fncFormatInputs();
                                    matPreloader("off");
                                    fncSweetAlert("close", "", "");
                                    fncSweetAlert("success", "' . $response->response->data->comment . '", "/businesses/general");
                                </script>';

                        } else {

                            echo '<script>
                                    fncFormatInputs();
                                    matPreloader("off");
                                    fncSweetAlert("close", "", "");
                                    fncNotie(3, "Failed to save record");
                                </script>';

                        }

                    } else {

                        echo '<script>
                                fncFormatInputs();
                                matPreloader("off");
                                fncSweetAlert("close", "", "");
                                fncNotie(3, "Failed to save record");
                            </script>';

                    }

                } else {

                    echo '<script>
                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncNotie(3, "Failed to save record");
                        </script>';

                }

            } else {

                echo '<script>
						fncFormatInputs();
						matPreloader("off");
						fncSweetAlert("close", "", "");
						fncNotie(3, "Field syntax error");
					</script>';

            }

        }

    }

}