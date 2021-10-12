<?php

require_once('nav.php');
require_once('header.php');

?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Agregar empresa</h2>
            <form action="<?php echo FRONT_ROOT ?>Company/Add" method="post" class="bg-light-alpha p-5">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Nombre de la empresa</label>
                            <input type="text" name="name" value="" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Ciudad</label>
                            <input type="text" name="city" value="" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div>
                            <select name="category" class="form-control">
                                <option value="" selected>Categoria</option>
                                <option value="Ingenieria">Ingenieria</option>
                                <option value="Programacion">Programacion</option>
                                <option value="Agriculcura">Agriculcura</option>
                                <option value="Seguridad e Higiene"> Seguridad e Higiene</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" name="" class="btn btn-dark ml-auto d-block">Agregar</button>
            </form>
        </div>
    </section>
</main>