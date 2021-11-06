<?php
require_once('header.php');
?>
<main class="d-flex align-items-center justify-content-center height-100 bg-blue">
     <div class="conteiner ">
          <?php
          if ($alert) { ?>
               <div class="alert text-center fw-bold alert-<?php echo $alert->getType() ?>" role="alert">
                    <?php echo $alert->getMessage() ?>
               </div>
          <?php } ?>
          <form action="<?php echo FRONT_ROOT ?>Logger/LogIn" method="POST" class="login-form p-5">
               <div class="logo">
                    <img src="../<?php echo VIEWS_PATH?>img/logo-utn-recruitment.png" width="30vw" alt="logo utn">
               </div>
               <div class="form-group">
                    <input type="text" name="username" class="form-input form-control" placeholder="Ingresar email" required>
               </div>
               <div class="form-group">
                    <input type="text" name="password" class="form-input form-control" placeholder="Ingresar constraseña">
               </div>

               <button class="btn p-2 button-blue w-100" type="submit">Iniciar Sesión</button>
               <div class="mt-1">
                    <a id="registerLink" class="p-0 nav-link" href="<?php echo FRONT_ROOT ?>User/ShowRegisterView">Registrarse</a>
               </div>
          </form>
     </div>
</main>