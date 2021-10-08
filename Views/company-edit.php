<?php

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
                            <input type="text" name="name" value="<?php echo $company->getName() ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Ciudad</label>
                            <input type="text" name="city" value="<?php echo $company->getCity() ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                        <label for="">Categoría</label>
                            <select name="category" class="form-control">
                                <option value="<?php echo $company->getCategory() ?>" selected><?php echo $company->getCategory() ?></option>
                                <option value="Ingenieria">Ingenieria</option>
                                <option value="Programacion">Programacion</option>
                                <option value="Agriculcura">Agriculcura</option>
                                <option value="Seguridad e Higiene"> Seguridad e Higiene</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Estado</label>
                            <select name="state" value="<?php echo $company->getState() ?>" class="form-control">
                                <option value="true">Activo</option>
                                <option value="false">Inactivo</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" name="idCompany" value="<?php echo $company->getIdCompany() ?>" class="btn btn-dark ml-auto d-block">Editar</button>
            </form>
        </div>
    </section>
</main>