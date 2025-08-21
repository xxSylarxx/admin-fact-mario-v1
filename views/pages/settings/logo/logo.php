<div class="tab-base p-relative">

    <!-- Nav tabs -->
    <ul class="nav nav-callout">
        <li class="nav-item waves-effect" onclick="window.open('/settings/general','_self');">
            <button class="nav-link" type="button">General</button>
        </li>
        <li class="nav-item waves-effect" onclick="window.open('/settings/server','_self');">
            <button class="nav-link" type="button">Servidor Correo</button>
        </li>
        <li class="nav-item waves-effect" onclick="window.open('/settings/logo','_self');">
            <button class="nav-link active" type="button">Logo</button>
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
            <h5 class="card-title">Cargar Logo</h5>
            <p>Realiza la carga del logo de la empresa en formato <b>".png"</b> o <b>".jpg"</b>.</p>
        </div>

        <div>

            <form class="needs-validation" novalidate method="post" enctype="multipart/form-data" autocomplete="off">

                <?php

                    if($dataSett->logo_sistema_configuracion == '') {

                        $imgSett = TemplateController::returnImgDefault('logo.png', '');

                    } else {

                        $imgSett = TemplateController::returnImg('img/logo', $dataSett->logo_sistema_configuracion);

                    }

                ?>

                <div class="row">

                    <div class="col-md-6 hidden">
                        <div class="form-floating mb-3">
                            <input type="file" name="image-emp" id="image-emp" class="form-control" accept="image/*" onchange="validateImageJS(event,'changePicture')">
                            <label for="image-emp" class="mb-2">Logo (.png / .jpg)<sup class="text-danger">*</sup></label>
                        </div>
                    </div>

                    <div class="col-md-12 text-center">
                        <label for="image-emp" class="d-flex justify-content-center">
                                    
                            <figure class="text-center py-3">
                                
                                <img src="<?php echo $imgSett ?>" class="img-fluid changePicture img__register">

                            </figure>

                        </label>
                        <small class="py-3 mb-3 text-muted">Recomendado 400 x 84 pixeles</small>
                    </div>

                    <div class="invalid-feedback">Este campo es obligatorio</div>

                    <?php

                        /*=============================================
                        Controladores
                        =============================================*/
                        require_once "controllers/settings.controller.php";

                        $edit = new SettingsController();
                        $edit->editLogo();

                    ?>

                    <div class="col-md-12 mt-4 text-center">

                        <a class="btn btn-danger" href="/settings/logo">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>