<?php

/*-------------------------
Autor: Developer Technology
Web: www.developer-technology.net
Mail: info@developer-technology.net
---------------------------*/

class UsersController
{

    /*=============================================
    Login de usuarios
    =============================================*/
    public function login()
    {

        if (isset($_POST["loginEmail"])) {

            echo '<script>
                    matPreloader("on");
                    fncSweetAlert("loading", "Cargando...", "");
                </script>';

            /*=============================================
            Recogemos los campos
            =============================================*/
            $url = "usuarios?login=true&suffix=usuario";
            $method = "POST";
            $fields = array(
                "email_usuario" => $_POST["loginEmail"],
                "clave_usuario" => $_POST["loginPassword"],
            );
            $token = TemplateController::tokenSet();

            $response = CurlController::requestSunat($url, $method, $fields, $token);

            if ($response->response->success == true) {

                /*=============================================
                Validamos que el usuario este activo
                =============================================*/
                if ($response->response->data[0]->estado_usuario != 1) {

                    echo '<script>
                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                        </script>
                        <div class="alert alert-warning mt-3 text-center">You do not have permissions to access</div>';
                    return;
                }

                /*=============================================
                Validamos que el usuario este verificado
                =============================================*/
                if ($response->response->data[0]->verificado_usuario != 1) {

                    echo '<script>
                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                        </script>
                        <div class="alert alert-info mt-3 text-center">Your account is not verified</div>';
                    return;
                }

                $_SESSION["empresa"] = '';
                $_SESSION["user"] = $response->response->data[0];

                echo '<script>
                        fncFormatInputs();
                        localStorage.setItem("token_user", "' . $response->response->data[0]->token_usuario . '");
                        window.location = "' . $_SERVER["REQUEST_URI"] . '"
                    </script>';

            } else {

                echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                    </script>
                    <div class="alert alert-danger text-center mt-4">' . $response->response->message . '</div>';

            }

        }

    }

    /*=============================================
    Registro de usuarios
    =============================================*/
    public function register()
    {

        if (isset($_POST["registerEmail"])) {

            echo '<script>
                    matPreloader("on");
                    fncSweetAlert("loading", "Cargando...", "");
                </script>';

            /*=============================================
            Validamos la sintaxis del correo
            =============================================*/
            if ($_POST["registerPassword"] == $_POST["confirmPass"]) {

                /*=============================================
                Creamos el alias
                =============================================*/
                $username = strtolower(explode("@", $_POST["registerEmail"])[0]);
                $email = strtolower($_POST["registerEmail"]);

                $url = "usuarios?register=true&suffix=usuario";
                $method = "POST";
                $fields = array(
                    "alias_usuario" => $username,
                    "clave_usuario" => $_POST["registerPassword"],
                    "email_usuario" => $email,
                    "nombres_usuario" => TemplateController::capitalize($_POST["registerName"]),
                    "telefono_usuario" => $_POST["registerPhone"],
                    "rol_usuario" => 2,
                    "estado_usuario" => 1,
                    "metodo_usuario" => "Directo",
                    "creado_usuario" => date('Y-m-d')
                );
                $token = TemplateController::tokenSet();

                $response = CurlController::requestSunat($url, $method, $fields, $token);

                if ($response->response->success == true) {

                    $url = "usuarios?id=" . $email . "&nameId=email_usuario&token=no-token&table=usuarios&suffix=usuario";
                    $method = "PUT";
                    $fields = "avatar_usuario=" . $response->response->data->avatar;

                    $response = CurlController::requestSunat($url, $method, $fields, $token);

                    echo '<script>
                            fncFormatInputs()
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                        </script>
                        <div class="alert alert-success text-center mt-4">' . $response->response->data->comment . '</div>';

                } else {

                    echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                    </script>
                    <div class="alert alert-danger text-center mt-4">' . $response->response->message . '</div>';

                }

            } else {

                echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                    </script>
                    <div class="alert alert-warning text-center mt-4">Passwords match</div>';

            }

        }

    }

    /*=============================================
    Mostrar datos
    =============================================*/
    public static function dataUser()
    {

        $url = "usuarios?select=*&linkTo=id_usuario&equalTo=" . $_SESSION["user"]->id_usuario;
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
    Cambiar contraseña
    =============================================*/
    public static function changePass($id, $actual)
    {

        if (isset($_POST["new-pass"])) {

            echo '<script>
                    matPreloader("on");
                    fncSweetAlert("loading", "Cargando...", "");
                </script>';

            /*=============================================
            Validamos la contraseña actual
            =============================================*/
            $crypt = crypt($_POST["actual-pass"], '$2a$07$azybxcags23425sdg23sdfhsd$');

            if ($crypt == $actual) {

                /*=============================================
                Validamos que la contraseña nueva coincida
                =============================================*/
                if ($_POST["new-pass"] == $_POST["confirm-pass"]) {

                    $newPass = crypt($_POST["new-pass"], '$2a$07$azybxcags23425sdg23sdfhsd$');

                    $url = "usuarios?id=" . $id . "&nameId=id_usuario&token=" . $_SESSION["user"]->token_usuario . "&table=usuarios&suffix=usuario";
                    $method = "PUT";
                    $fields = "clave_usuario=" . $newPass;
                    $token = TemplateController::tokenSet();

                    $response = CurlController::requestSunat($url, $method, $fields, $token);

                    if ($response->response->success == true) {

                        echo '<script>
								fncFormatInputs();
								matPreloader("off");
								fncSweetAlert("close", "", "");
								fncSweetAlert("success", "' . $response->response->data->comment . '", "/profile");
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
                        </script>
                        <div class="alert alert-warning text-center mt-4">Passwords do not match</div>';

                }

            } else {

                echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                    </script>
                    <div class="alert alert-warning text-center mt-4">The current password is incorrect</div>';

            }

        }

    }

    /*=============================================
    Actualizar perfil
    =============================================*/
    public static function updateProfile($id)
    {

        if (isset($_POST["name-user"])) {

            echo '<script>
                    matPreloader("on");
                    fncSweetAlert("loading", "Cargando...", "");
                </script>';

            $select = "id_usuario,avatar_usuario";

            $url = "usuarios?select=" . $select . "&linkTo=id_usuario&equalTo=" . $id;
            $method = "GET";
            $token = TemplateController::tokenSet();
            $fields = array();

            $response = CurlController::requestSunat($url, $method, $fields, $token);

            if ($response->response->success == true) {

                /*=============================================
                Validar cambio imagen
                =============================================*/
                if (isset($_FILES["file-user"]["tmp_name"]) && !empty($_FILES["file-user"]["tmp_name"])) {

                    /*=============================================
                    Borramos el archivo actual
                    =============================================*/
                    $urlDel = "file/delete";
                    $methodDel = "POST";
                    $fieldsDel = array(

                        "deleteUniqueFile" => $response->response->data[0]->avatar_usuario,
                        "deleteDir" => "img",
                        "deleteFol" => "users",
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

                        "file" => $_FILES["file-user"]["tmp_name"],
                        "type" => $_FILES["file-user"]["type"],
                        "mode" => "base64",
                        "folder" => "documents/img/users",
                        "name" => base64_encode("avatar_" . time()),
                        "width" => 800,
                        "height" => 800,

                    );
                    $dataFielUp = json_encode($fieldsUp);

                    $saveImageUser = CurlController::requestSunat($urlUp, $methodUp, $dataFielUp, $token)->response->file;

                } else {

                    $saveImageUser = $response->response->data[0]->avatar_usuario;

                }

                echo $_FILES["file-user"]["type"];

                $url = "usuarios?id=" . $id . "&nameId=id_usuario&token=" . $_SESSION["user"]->token_usuario . "&table=usuarios&suffix=usuario";
                $method = "PUT";
                $fields = "nombres_usuario=" . $_POST["name-user"] . "&telefono_usuario=" . $_POST["phone-user"] . "&avatar_usuario=" . $saveImageUser;

                $response = CurlController::requestSunat($url, $method, $fields, $token);

                if ($response->response->success == true) {

                    echo '<script>
                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncSweetAlert("success", "' . $response->response->data->comment . '", "/profile");
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
    Generar nueva contraseña
    =============================================*/
    public static function forgot()
    {

        if (isset($_POST["forgotEmail"])) {

            echo '<script>
                    matPreloader("on");
                    fncSweetAlert("loading", "Cargando...", "");
                </script>';

            $url = "usuarios?forgot=true&suffix=usuario";
            $method = "POST";
            $fields = array(
                "email_usuario" => $_POST["forgotEmail"],
            );
            $token = TemplateController::tokenSet();

            $response = CurlController::requestSunat($url, $method, $fields, $token);

            if ($response->response->success == true) {

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
                        fncNotie(3, "' . $response->response->message . '");
                    </script>';

            }

        }

    }

}