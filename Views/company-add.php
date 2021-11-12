<?php
require_once('header.php');
if($_SESSION['loggedUser']->getRole() != "Company"){
    require_once('nav.php');
}
?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4 text-center">Nueva empresa</h2>
            <?php
            if ($alert) {
            ?>
                <div class="alert alert-<?php echo $alert->getType() ?> text-center fwbold" role="alert"><?php echo $alert->getMessage() ?></div>
            <?php
            }
            ?>
            <form action="<?php echo FRONT_ROOT ?>Company/Add" method="post" class="bg-light-alpha p-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control form-input" placeholder="Nombre de la empresa" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="phoneNumber" class="form-control form-input shadow-none" placeholder="Número de teléfono" pattern="[0-9]{3}+\-+[0-9]{4}$" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="email" class="form-control form-input shadow-none" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"  value="<?php echo ($email) ? $email : "" ?>" required <?php echo ($email) ? "readonly" : "" ?>>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea name="description" class="form-control form-textarea" placeholder="Sobre la empresa" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="stateName" class="form-control form-input" placeholder="Provincia" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="city" class="form-control form-input" placeholder="Ciudad" required>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="number" name="postalCode" class="form-control form-input" placeholder="Código Postal" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="streetName" value="" class="form-control form-input" placeholder="Calle" required>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="number" name="streetAddress" value="" class="form-control form-input" placeholder="Número" required>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 justify-content-end">
                    <div class="col-md-3">
                        <button type="submit" class="btn button-blue w-100">Agregar</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>

<?php
require_once("footer.php");
?>