<?php
require_once('header.php');
?>
<main id="login" class="d-flex align-items-center justify-content-center height-100">
     <div class="content">
          <form action="<?php echo FRONT_ROOT ?>Student/LogIn" method="POST" class="login-form p-5">
               <div class="logo">
                    <img src="Views\img\logo-utn-recruitment.png" width="600px" alt="logo utn">
               </div>
               <div class="form-group">
                    <input type="text" name="username" class="form-input" placeholder="Ingresar usuario">
               </div>
               <div class="form-group">
                    <input type="text" name="password" class="form-input" placeholder="Ingresar constraseña">
               </div>
               <button class="button-blue width-100" type="submit">Iniciar Sesión</button>
          </form>
     </div>
</main>