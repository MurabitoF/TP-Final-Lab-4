<?php
require_once('verify-login.php');
require_once('nav.php');
require_once('header.php');

?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Editar empresa</h2>
            <form action="<?php echo FRONT_ROOT ?>Company/Edit" method="post" class="bg-light-alpha p-5">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Nombre de la empresa</label>
                            <input type="text" name="name" value="<?php echo $company->getName() ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Ciudad</label>
                            <input type="text" name="city" value="<?php echo $company->getCity() ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                        <label for="">Categoría</label>
                            <select name="category" class="form-control" required>
                                <option value="<?php echo $career->getIdCareer() ?>" selected><?php echo $career->getName() ?></option>
                                <?php
                                    foreach($careerList as $career)
                                    {
                                     if($career->getActive())
                                     {
                                        ?>
                                            <option value="<?php echo $career->getIdCareer()?>"><?php echo $career->getName() ?></option> 
                                        <?php
                                     }   
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Descripción</label>
                            <textarea type="text" name="description" value="<?php echo $company->getDescription() ?>" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Calle de la sucursal</label>
                            <input type="text" name="street" value="<?php echo $company->getStreet() ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Número de calle</label>
                            <input type="number" name="streetAddress" value="<?php echo $company->getStreetAddress() ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Código Postal</label>
                            <input type="number" name="postalCode" value="<?php echo $company->getPostalCode() ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                            <label for="">Estado</label>
                            <select name="state" value="<?php echo $company->getState() ?>" class="form-control">
                                <option value="true">Activo</option>
                                <option value="false">Inactivo</option>
                            </select>
                        </div>
                    </div>
                        <div class="col-lg-4">
                            <button type="submit" name="idCompany" value="<?php echo $company->getIdCompany() ?>" class="btn btn-dark ml-auto d-block">Editar</button>
                        </div>  
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>