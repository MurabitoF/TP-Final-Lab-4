<?php
require_once('header.php');
require_once('nav.php');
?>

<main>
     <section id="listado" class="mb-5 pt-5">
          <div class="container">
          
               <section id="first-steps" class="">
                    <h2>Como usar el sistema</h2>
                    <div class="separator"></div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus nobis officiis aliquid aliquam voluptatem deleniti asperiores consequatur, molestias assumenda quo. Necessitatibus assumenda dolor laudantium nesciunt magni quis illum minima sequi?</p>
               </section>
               <?php if($_SESSION['loggedUser']->getRole() == "Student"){?>
               <section id="last-applications" class="">
                    <h2>Ultimas postulaciones</h2>
                    <div class="separator"></div>
                    <div class="row">
                         <?php if ($lastApplications) {
                              foreach ($lastApplications as $application) { ?>
                                   <div class="col-xl-4">
                                        <div class="card card-shadow">
                                             <div class="card-body">
                                                  <h5 class="card-title">
                                                       <a class="link-button" href="<?php echo FRONT_ROOT . "JobOffer/ShowPostView?idJobOffer=" . $application->getIdJobOffer()?>">
                                                            <?php echo ucwords($application->getTitle()) ?>
                                                       </a>
                                                  </h5>
                                                  <div class="separator-black"></div>
                                                  <h6>Ciudad</h6>
                                                  <span><?php echo $application->getCity() ?></span>
                                                  <h6>Carga Horaria</h6>
                                                  <span><?php echo $application->getWorkload() ?></span>
                                                  <h6>Fecha de Cierre</h6>
                                                  <span><?php echo $application->getExpireDate() ?></span>
                                             </div>
                                             <div class="card-header text-center fw-bold <?php echo ($application->getStatus() == "Open") ? "bg-open" : "bg-closed" ?>">
                                                  <?php echo ($application->getStatus() == "Open") ? "Abierta" : "Cerrada" ?>
                                             </div>
                                        </div>
                                   </div>
                              <?php }
                         } else { ?>
                              <h4>No tenes ninguna postulacion</h4>
                         <?php } ?>
                    </div>
                    <div class="row justify-content-end mt-3">
                         <div class="col-md-6 text-md-end">
                              <a class="link-button" href="<?php echo FRONT_ROOT . "JobOffer/ShowHistoryApplicantsList?idStudent=" . $_SESSION['loggedUser']->getStudentId() ?>">Ver historial de postulaciones<i class="ms-3 fas fa-angle-right"></i></a>
                         </div>
                    </div>
               </section>
               <?php } ?>
          </div>
     </section>
</main>