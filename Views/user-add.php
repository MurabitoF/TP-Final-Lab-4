<?php
require_once('header.php');
require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar usuario</h2>
               <?php if(isset($alert)){ ?>
                    <div class="alert alert-<?php echo $alert->getType() ?> text-center fw-bold" role="alert">
                            <?php echo $alert->getMessage() ?>
                    </div>
               <?php } ?>
               <form action="<?php echo FRONT_ROOT ?>User/Add" method="post" class="p-5">
                    <div class="row">
                         <div class="col-md-6">
                              <div class="form-group">
                                   <input type="text" name="username" class="form-control form-input" placeholder="Email">
                              </div>
                         </div>
                         <div class="col-md-4">
                              <select class="form-select form-input " name="role">
                                   <option value="Admin">Administrador</option>
                                   <option value="Company">Empresa</option>
                                   <option value="Student">Alumno</option>
                              </select>
                         </div>
                    </div>
                    <div class="row">
                         <div class="col-md-12">
                              <input class="form-control form-input" id="passwordInput" type="text" placeholder="Ingrese una contraseña" required>
                              <span id="strengthDisp" class="visually-hidden badge displayBadge">Debil</span>
                              <p class="fst-italic mt-1 pass-text">
                                   La contraseña debería tener al menos 6 caracter(es), al menos 1 minúscula(s), al menos 1 numero(s) y al menos 1 caracter(es) especial
                              </p>
                         </div>
                    </div>
                    <div class="row">
                         <div class="col-md-12">
                              <input class="form-control mb-1 form-input" name="verifiedPassword" id="verify-password" type="text" placeholder="Repita la contraseña" required disabled>
                              <p id="pass-error" class="fst-italic mt-0 pass-text"></p>
                         </div>
                    </div>
                    <div class="row justify-content-end">
                         <div class="col-md-4">
                              <button type="submit" class="btn button-blue w-100">Agregar</button>
                         </div>
                    </div>
               </form>
          </div>
     </section>
</main>
<script src="../<?php echo VIEWS_PATH?>js/main.js"></script>