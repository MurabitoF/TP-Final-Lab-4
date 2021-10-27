<?php
require_once('header.php');
?>
<main id="login" class="height-100">
     <div class="container bg-white height-100">
          <div class="row ms-1 me-1 justify-content-center">
               <div class="col-6">
                    <div class="logo">
                         <a href="<?php echo FRONT_ROOT ?>User/ShowLogInView">
                              <img src="http://localhost/TP-Final-Lab-4/Views/img/logo-utn-recruitment.png" width="300vw" alt="logo utn">
                         </a>
                    </div>
                    <form class="mt-5" action="<?php echo FRONT_ROOT ?>User/VerifyEmail" method="POST">
                         <div class="row align-items-center justify-content-between">
                              <div class="form-group col-sm-8">
                                   <input name="email" class="form-input form-controller shadow-none" type="text" placeholder="Ingrese su email">
                              </div>
                              <div class="col-sm-3">
                                   <button type="submit" class="mb-2 btn button-blue">Verificar</button>
                              </div>
                         </div>
                    </form>
               </div>
               <div class="separator"></div>
               <?php if ($user) { ?>
                    <div id="student-data" class="col-8 slide-in-top">
                         <form action="<?php FRONT_ROOT?>Add" method="POST">
                              <div class="row">
                                   <div class="col-md-4 form-floating">
                                        <input class="form-control form-input" id="firstName" type="text" value="<?php echo $user->getFirstName() ?>" disabled>
                                        <label for="firstName">Nombre</label>
                                   </div>
                                   <div class="col-md-4 form-floating">
                                        <input class="form-control form-input" id="lastName" type="text" value="<?php echo $user->getLastName() ?>" disabled>
                                        <label for="lastName">Apellido</label>
                                   </div>
                                   <div class="col-md-4 form-floating">
                                        <input class="form-control form-input" id="dni" type="text" value="<?php echo $user->getDni() ?>" disabled>
                                        <label for="dni">DNI</label>
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col-md-3 form-floating">
                                        <input class="form-control form-input" id="gender" type="text" value="<?php echo $user->getGender() ?>" disabled>
                                        <label for="gender">Genero</label>
                                   </div>
                                   <div class="col-md-4 form-floating">
                                        <input class="form-control form-input" id="birthDate" type="text" value="<?php echo date("d/m/y", strtotime($user->getBirthDate())) ?>" disabled>
                                        <label for="birthDate">Fecha Nacimiento</label>
                                   </div>
                                   <div class="col-md-5 form-floating">
                                        <input class="form-control form-input" id="phoneNumber" type="text" value="<?php echo $user->getPhoneNumber() ?>" disabled>
                                        <label for="phoneNumber">Nro Telefono</label>
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col-md-3 form-floating">
                                        <input class="form-control form-input" id="fileNumber" type="text" value="<?php echo $user->getFileNumber() ?>" disabled>
                                        <label for="fileNumber">Legajo</label>
                                   </div>
                                   <div class="col-md-9 form-floating">
                                        <input class="form-control form-input" id="carrerId" type="text" value="<?php echo $user->getCareerId() ?>" disabled>
                                        <label for="careerId">Carrera</label>
                                   </div>
                              </div>
                              <div class="row align-items-center mt-3">
                                   <div class="col-md-11 form-floating">
                                        <input class="form-control form-input" name="username" id="email" type="text" value="<?php echo $user->getEmail() ?>" readonly>
                                        <label for="email">Email</label>
                                   </div>
                                   <div class="col-md-1 pos-relative">
                                        <button 
                                        type="button" 
                                        id="info-icon" 
                                        data-bs-toggle="popover" 
                                        data-bs-trigger="focus" 
                                        title="Importante" 
                                        data-bs-content="Este sera el email con el que inicies sesion, si algun dato es incorrecto contactate con la UTN">
                                             <i class="fas fa-info-circle"></i>
                                        </button>
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
                                   <div class="mt-4 col-md-3">
                                        <button type="submit" class="btn button-blue" disabled>Registrarme</button>
                                   </div>
                              </div>
                         </form>
                    </div>
               <?php }
               if ($message) { ?>
                    <div class="col-6">
                         <h1><?php echo $message ?></h1>
                    </div>
               <?php } ?>
          </div>
     </div>
</main>
<script src="../<?php echo VIEWS_PATH?>js/main.js"></script>
<script src="../<?php echo VIEWS_PATH?>js/bootstrap.bundle.min.js"></script>
<script>
     var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
     var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
          return new bootstrap.Popover(popoverTriggerEl)
     });
</script>