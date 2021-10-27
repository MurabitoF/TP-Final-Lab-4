<?php
require_once('header.php');
?>
<main id="login" class="d-flex align-items-center justify-content-center height-100">
     <div class="conteiner ">
          <?php
          if ($alert) { ?>
               <div class="alert alert-<?php echo $alert->getType() ?>" role="alert">
                    <?php echo $alert->getMessage() ?>
               </div>
          <?php } ?>
          <form action="<?php echo FRONT_ROOT ?>User/LogIn" method="POST" class="login-form p-5">
               <div class="logo">
                    <img src="http://localhost/TP-Final-Lab-4/Views/img/logo-utn-recruitment.png" width="30vw" alt="logo utn">
               </div>
               <div class="form-group">
                    <input type="text" name="username" class="form-input form-control" placeholder="Ingresar email" required>
               </div>
               <div class="form-group">
                    <input type="text" name="password" class="form-input form-control" placeholder="Ingresar constraseña">
               </div>
               <div class="form-group mb-2">
                    <input class="form-check-input" type="checkbox" name="rememberMe" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Recordarme</label>
               </div>
               <button class="btn p-2 button-blue width-100" type="submit">Iniciar Sesión</button>
               <div class="mt-1">
                    <a id="registerLink" class="p-0 nav-link" href="<?php echo FRONT_ROOT ?>User/ShowRegisterView">Registrarse</a>
               </div>
          </form>
     </div>
</main>