<?php
require_once('verify-login.php');
require_once('nav.php');
require_once('header.php');

?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4 text-center">Editar empresa</h2>
            <form action="<?php echo FRONT_ROOT ?>Company/Edit" method="post" class="bg-light-alpha p-5">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control form-input" placeholder="Nombre de la empresa" value="<?php echo $company->getName() ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="cuit" class="form-control form-input shadow-none" placeholder="C.U.I.T." value="<?php echo $company->getCUIT() ?>" pattern="[0-9]{2}+\-+[0-9]{8}+\-+[0-9]{1}$" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="phoneNumber" class="form-control form-input shadow-none" pattern="[0-9]{3}+\-+[0-9]{4}$" placeholder="Número de teléfono (555)555-5555 " value="<?php echo $company->getPhoneNumber() ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="email" class="form-control form-input shadow-none" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Email" value="<?php echo $company->getEmail() ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea name="description" class="form-control form-textarea" placeholder="Sobre la empresa" value="<?php echo $company->getDescription() ?>" required> <?php echo $company->getDescription() ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="city" class="form-control form-input" placeholder="Ciudad" value="<?php echo $address->getCity() ?>" required>
                        </div>
                    </div>                    
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="streetName" class="form-control form-input" value="<?php echo $address->getStreetName() ?>" required>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="number" name="streetAddress" class="form-control form-input" value="<?php echo $address->getStreetAddress() ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <select name="state" value="<?php echo $company->getState() ?>" class="form-control">
                                <option value="true">Activo</option>
                                <option value="false">Inactivo</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 justify-content-end">
                    <div class="col-md-3">
                        <button type="submit" class="btn button-blue w-100" name="idCompany" value="<?php echo $company->getIdCompany() ?>">Editar</button>
                    </div>
                </div>           
            </form>
        </div>
    </section>
</main>