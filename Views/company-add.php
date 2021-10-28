<?php
require_once('verify-login.php');
require_once('nav.php');
require_once('header.php');

?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4 text-center">Agregar empresa</h2>
            <form action="<?php echo FRONT_ROOT ?>Company/Add" method="post" class="bg-light-alpha p-5">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control form-input" placeholder="Nombre de la empresa" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="number" name="cuit" class="form-control form-input shadow-none" placeholder="C.U.I.T." required>
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
                            <input type="text" name="city" class="form-control form-input" placeholder="Ciudad" required>
                        </div>
                    </div>                    
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="streetName" value="" class="form-control form-input" placeholder="Calle" required>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="number" name="streetAddress" value="" class="form-control form-input" placeholder="Número de calle" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <select name="category" class="form-select form-input" required>
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
require_once ("footer.php");
?>