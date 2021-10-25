<?php
require_once('verify-login.php');
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
                            <input type="text" name="name" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Ciudad</label>
                            <input type="text" name="city" value="" class="form-control" required>
                        </div>
                    </div>                    
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Código Postal</label>
                            <input type="number" name="postalCode" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                        <label for="">Categoría</label>
                            <select name="category" class="form-control" required>
                                <option value="" selected>Categoria</option>
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
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Descripción</label>
                            <textarea type="text" name="description" value="" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Calle de la sucursal</label>
                            <input type="text" name="street" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Número de calle</label>
                            <input type="number" name="streetAddress" value="" class="form-control" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark ml-auto d-block">Agregar</button>           
            </form>
        </div>
    </section>
</main>