<?php

    /*=============================================
    Inlcuimos el modal de las credenciales
    =============================================*/
    include "views/modals/apiSunat.php";

    /*=============================================
    Nombre sistema
    =============================================*/
    if (isset($_POST["name-sys"])){

        $name_sys = $_POST["name-sys"];

    } else {

        $name_sys = "";

    }

    /*=============================================
    Nombre empresa
    =============================================*/
    if (isset($_POST["name-emp"])){

        $name_emp = $_POST["name-emp"];

    } else {

        $name_emp = "";

    }

    /*=============================================
    Web empresa
    =============================================*/
    if (isset($_POST["web-emp"])){

        $web_emp = $_POST["web-emp"];

    } else {

        $web_emp = "";

    }

    /*=============================================
    Descripcion empresa
    =============================================*/
    if (isset($_POST["description-emp"])){

        $description_emp = $_POST["description-emp"];

    } else {

        $description_emp = "";

    }

    /*=============================================
    Palabras clave empresa
    =============================================*/
    if (isset($_POST["kw-emp"])){

        $kw_emp = $_POST["kw-emp"];

    } else {

        $kw_emp = "";

    }

    /*=============================================
    ID Sunat
    =============================================*/
    if (isset($_POST["id-sunat"])){

        $id_sunat = $_POST["id-sunat"];

    } else {

        $id_sunat = "";

    }

    /*=============================================
    Clave Sunat
    =============================================*/
    if (isset($_POST["clave-sunat"])){

        $clave_sunat = $_POST["clave-sunat"];

    } else {

        $clave_sunat = "";

    }

?>

<div class="tab-base p-relative">

    <!-- Nav tabs -->
    <ul class="nav nav-callout">
        <li class="nav-item waves-effect" onclick="window.open('/settings/general','_self');">
            <button class="nav-link active" type="button">General</button>
        </li>
        <li class="nav-item waves-effect" onclick="window.open('/settings/server','_self');">
            <button class="nav-link" type="button">Servidor Correo</button>
        </li>
        <li class="nav-item waves-effect" onclick="window.open('/settings/logo','_self');">
            <button class="nav-link" type="button">Logo</button>
        </li>
        <li class="nav-item waves-effect" onclick="window.open('/settings/favicon','_self');">
            <button class="nav-link" type="button">Favicon</button>
        </li>
        <li class="nav-item waves-effect" onclick="window.open('/settings/gateway','_self');">
            <button class="nav-link" type="button">Pasarelas De Pago</button>
        </li>
    </ul>

    <!-- Tabs content -->
    <div class="tab-content br-bottom">

        <div class="tab-pane fade show active">
            <h5 class="card-title">Configuración General</h5>
            <p>Requerido para la personalización de datos en el front, SEO y correos enviados</p>
        </div>

        <form method="post" class="needs-validation" novalidate autocomplete="off">

            <div class="row">

                <!--=====================================
                Sistema
                ======================================-->
                <div class="col-md-4">

                    <div class="form-floating mt-2 mb-3">

                        <input type="text" name="name-sys" class="form-control" placeholder="Nombre del sistema" value="<?php echo $dataSett->nombre_sistema_configuracion ?>" required>
                        <label for="">Nombre del sistema <sup class="text-danger">*</sup></label>

                    </div>

                </div>

                <!--=====================================
                Empresa
                ======================================-->
                <div class="col-md-4">

                    <div class="form-floating mt-2 mb-3">

                        <input type="text" name="name-emp" class="form-control" placeholder="Nombre de la empresa" value="<?php echo $dataSett->nombre_empresa_configuracion ?>" required>
                        <label for="">Nombre de la empresa <sup class="text-danger">*</sup></label>

                    </div>

                </div>

                <!--=====================================
                Web
                ======================================-->
                <div class="col-md-4">

                    <div class="form-floating mt-2 mb-3">

                        <input type="url" name="web-emp" class="form-control" placeholder="Web de la empresa" value="<?php echo $dataSett->web_empresa_configuracion ?>" required>
                        <label for="">Web de la empresa <sup class="text-danger">*</sup></label>

                    </div>

                </div>

                <!--=====================================
                Palabras Claves
                ======================================-->
                <div class="col-md-12">

                    <div class="form-group mt-2 mb-3">

                        <input
                        type="text"
                        class="form-control tags-input"
                        pattern='[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
                        onchange="validateJS(event,'regex')"
                        value="<?php echo implode(",", json_decode($dataSett->keywords_configuracion, true)) ?>"
                        name="kw-emp"
                        placeholder="Palabras clave"
                        required>

                    </div>

                </div>

                <!--=====================================
                Descripción
                ======================================-->
                <div class="col-md-12">

                    <div class="form-group mt-2 mb-3">
                        
                        <label>Descripción <sup class="text-danger">*</sup></label>

                        <textarea
                        class="summernote"
                        name="description-emp"
                        required
                        ><?php echo $dataSett->descripcion_configuracion ?></textarea>

                        <div class="invalid-feedback">Este campo es obligatorio</div>

                    </div>

                </div>

            </div>

            <hr>

            <h5>Credenciales SUNAT</h5>
            <p>Requerido para el consumo de la API pública de la SUNAT como la consulta de CPE. <a class="pointer text-primary" data-toggle="modal" data-target="#apiSunat">¿Cómo consigo mis credenciales?</a></p>

            <div class="row">

                <!--=====================================
                ID SUNAT
                ======================================-->
                <div class="col-md-4">

                    <div class="form-floating mt-2 mb-3">

                        <input type="text" name="id-sunat" class="form-control" placeholder="ID" value="<?php echo $dataSett->id_sunat_configuracion ?>" required>
                        <label for="">ID <sup class="text-danger">*</sup></label>

                    </div>

                </div>

                <!--=====================================
                Clave SUNAT
                ======================================-->
                <div class="col-md-4">

                    <div class="form-floating mt-2 mb-3">

                        <input type="text" name="clave-sunat" class="form-control" placeholder="Clave" value="<?php echo $dataSett->clave_sunat_configuracion ?>" required>
                        <label for="">Clave <sup class="text-danger">*</sup></label>

                    </div>

                </div>

                <?php

                    /*=============================================
                    Controladores
                    =============================================*/
                    require_once "controllers/settings.controller.php";

                    $edit = new SettingsController();
                    $edit->editGeneral();

                ?>

                <!--=====================================
                Botones
                ======================================-->
                <div class="col-md-12 mt-4 text-center">

                    <a class="btn btn-danger" href="/settings/general">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>

                </div>

            </div>

        </form>

    </div>

</div>