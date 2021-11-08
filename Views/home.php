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
                                   <div class="col-md-4">
                                        <div class="card">
                                             <div class="card-body">                   
                                                  <?php $jobOffer = $this->jobOfferDAO->SearchId($application);?>
                                                  <h5 class="card-title"><a class="link-button" href="<?php echo FRONT_ROOT . "JobOffer/ShowPostView?idJobOffer=" . $jobOffer->getIdJobOffer() ?>">
                                                  <?php echo $jobOffer->getTitle(); ?>
                                                  </a></h5>
                                                  <p class="card-text"><?php echo $jobOffer->getDescription();?></p>
                                             </div>
                                             <div class="card-header text-center fw-bold">
                                                  Estado con color
                                             </div>
                                        </div>
                                   </div>
                              <?php }
                         } else { ?>
                              <h4>No tenes ninguna postulacion</h4>
                         <?php } ?>
                    </div>
                    <div class="row justify-content-end">
                         <div class="col-md-6 text-md-end">  
                         <a href="<?php echo FRONT_ROOT . "JobOffer/ShowHistoryApplicantsList?idUser=" . $_SESSION['loggedUser']->getIdUser() ?>"> Ver historial de postulaciones </a>

                         </div>
                    </div>
               </section>
               <?php } ?>
          </div>
     </section>
</main>

<?php
require_once('footer.php');
?>