<?php
require_once('verify-login.php');
require_once('header.php');
require_once('nav.php');
?>
<main>
     <section id="listado" class="mb-5">
          <div class="container">
               <section id="student-header" class="mt-3">
                    <div class="row bg-blue p-3 align-items-center">
                         <div class="col-md-4 ms-4">
                              <img class="img-profile" src="https://ceslava.s3-accelerate.amazonaws.com/2016/04/rZoltXj1-mistery-man-gravatar-wordpress-avatar-persona-misteriosa-510x510.png" alt="Student Photo">
                         </div>
                         <div class="col-md-6">
                              <h1 class="name"><?php echo $user->getFirstName() . ' ' .
                                                       $user->getLastName(); ?></h1>
                              <h3 class="student-university-data"><?php echo $user->getCareerid(); ?></h3>
                              <h3 class="student-university-data">Legajo: <?php echo $user->getFileNumber() ?></h3>
                              <?php if($user->getStudentId() == $_SESSION['loggedUser']->getStudentId() ){ ?>
                              <form action="#">
                                   <input type="file" name="cv" id="cv" hidden>
                                   <button type="submit" class="btn button-white fw-bold mt-2 py-2 px-5 width-100">Subi tu CV</button>
                              </form>
                              <?php } ?>
                         </div>
                    </div>
               </section>
               <section id="student-personal-info">
                    <div class="mt-5">
                         <h2 class="ms-3">Informacion Personal</h2>
                         <div class="separator"></div>
                         <div class="row">
                              <div class="col-md-4">
                                   <h3 class="info-title">D.N.I.</h3>
                              </div>
                              <div class="col-md-8">
                                   <?php echo $user->getDni() ?>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col-md-4">
                                   <h3 class="info-title">Edad</h3>
                              </div>
                              <div class="col-md-8">
                                   <?php
                                   $bdate = new DateTime($user->getBirthDate());
                                   $now = new DateTime();
                                   $age = $bdate->diff($now);

                                   echo $age->y.' Años';
                                   ?>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col-md-4">
                                   <h3 class="info-title">Genero</h3>
                              </div>
                              <div class="col-md-8">
                                   <?php echo $user->getGender() ?>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col-md-4">
                                   <h3 class="info-title">Email</h3>
                              </div>
                              <div class="col-md-8">
                                   <?php echo $user->getEmail() ?>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col-md-4">
                                   <h3 class="info-title">Telefono</h3>
                              </div>
                              <div class="col-md-8">
                              <?php echo $user->getPhoneNumber() ?>
                              </div>
                         </div>

                    </div>
               </section>
          </div>
     </section>
</main>

<?php
require_once('footer.php');
?>