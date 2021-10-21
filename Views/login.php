<?php
require_once('header.php');
?>
<main id="login" class="d-flex align-items-center justify-content-center height-100">
     <div class="conteiner">
          <form action="<?php echo FRONT_ROOT ?>User/LogIn" method="POST" class="login-form p-5">
               <div class="logo">
                    <img src="http://localhost/TP-Final-Lab-4/Views/img/logo-utn-recruitment.png" width="600px" alt="logo utn">
               </div>
               <div class="form-group">
                    <input type="text" name="username" class="form-input" placeholder="Ingresar email" required>
               </div>
               <div class="form-group">
                    <input type="text" name="password" class="form-input" placeholder="Ingresar constraseña">
               </div>
               <div class="form-group mb-2">
                    <input class="form-check-input" type="checkbox" name="rememberMe" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Recordarme</label>
               </div>
               <button class="button-blue width-100" type="submit">Iniciar Sesión</button>
          </form>
     </div>
</main>