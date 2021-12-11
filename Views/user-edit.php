<?php
require_once('header.php');
require_once('nav.php');
$loggedUser = $_SESSION['loggedUser'];
?>

<main class="py-5">
    <section class="mb-5">
        <div class="container">
            <h2 class="mb-4">Cambiar contraseña</h2>
            <?php if (isset($alert)) { ?>
                <div class="alert alert-<?php echo $alert->getType() ?> text-center fw-bold" role="alert">
                    <?php echo $alert->getMessage() ?>
                </div>
            <?php } ?>
            <form action="<?php echo FRONT_ROOT ?>User/EditPass" method="post" class="p-5">
                <div class="row">
                    <div class="col-md-12">
                        <input class="form-control mb-1 form-input" name="oldPass" type="text" placeholder="Ingrese la contraseña anterior" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input class="form-control form-input" id="passwordInput" type="text" placeholder="Ingrese la nueva contraseña" required>
                        <span id="strengthDisp" class="visually-hidden badge displayBadge">Debil</span>
                        <p class="fst-italic mt-1 pass-text">
                            La contraseña debería tener al menos 6 caracter(es), al menos 1 minúscula(s), al menos 1 numero(s) y al menos 1 caracter(es) especial
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input class="form-control mb-1 form-input" name="newPass" id="verify-password" type="text" placeholder="Repita la contraseña" required disabled>
                        <p id="pass-error" class="fst-italic mt-0 pass-text"></p>
                    </div>
                </div>
                <div class="visually-hidden">
                    <input type="text" name="idUser" value="<?php echo $userId ?>" readonly>
                </div>
                <div class="row justify-content-end">
                    <div class="col-md-4">
                        <button type="submit" class="btn button-blue w-100">Cambiar contraseña</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>

<script src="../<?php echo VIEWS_PATH ?>js/main.js"></script>