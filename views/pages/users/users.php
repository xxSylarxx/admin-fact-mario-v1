<div class="content__header content__boxed overlapping">
    <div class="content__wrap">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">

                <li class="breadcrumb-item"><a href="/">Inicio</a></li>

                <?php if (isset($routesArray[2])): ?>

                    <?php if ($routesArray[2] == "new" || $routesArray[2] == "edit"): ?>

                        <li class="breadcrumb-item"><a href="/users">Usuarios</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $txtBread ?></li>

                    <?php endif?>

                <?php else: ?>

                    <li class="breadcrumb-item active" aria-current="page">Usuarios</li>

                <?php endif?>

            </ol>
        </nav>
        <!-- END : Breadcrumb -->

        <h1 class="page-title mb-0 mt-2">Usuarios</h1>

        <p class="lead"></p>

    </div>

</div>

<div class="content__boxed">
    <div class="content__wrap">

        <?php

            include "actions/list.php";

        ?>

    </div>

</div>