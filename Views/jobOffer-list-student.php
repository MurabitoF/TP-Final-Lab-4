<?php
require_once('verify-login.php');
require_once('header.php');
require_once('nav.php');
?>

<main>
    <section id="jobOffer-list-student">
        <div class="container">
            <h2>Listado de Publicaciones</h2>
            <!-- Falta filtro -->
            <?php if (!empty($jobOfferList)) {
                foreach ($jobOfferList as $jobOffer) { 
                    if($jobOffer->getActive()){?>
                    <div class="row align-items-center justify-content-around jobOffer-card pt-2">
                        <div class="col-md-8 jobOffer-info">
                            <h2><?php echo $jobOffer->getTitle() ?></h2>
                            <div class="row justify-content-start jobOffer-tags"> <!--VER TEMA DE COMPANY-->
                                <div class="col-sm-2"><a href="#"><?php echo $jobOffer->getCompany() ?></a></div>

                                <?php foreach($jobPositionList as $jobPosition){ ///FOREACH FEO PARA MOSTRAR NOMBRE DE JOB POSITION
                                        if($jobPosition->getIdJobPosition() == $jobOffer->getJobPosition()){
                                             $nameJobPosition = $jobPosition->getName();
                                        }
                                      }
                                    ?>

                                <div class="col-sm-3"><?php echo $nameJobPosition ?></div>
                                <div class="col-sm-2"><?php echo $jobOffer->getCity() ?></div>
                            </div>
                            <div class="row jobOffer-tags">

                                <?php foreach($careerList as $career){ ///FOREACH FEO PARA MOSTRAR NOMBRE DE CAREER
                                        if($career->getIdCareer() == $jobOffer->getCareer()){
                                             $nameCareer = $career->getName();
                                        }
                                      }
                                    ?>

                                <div class="col-sm-8"><?php echo $nameCareer ?></div>
                            </div>
                            <div class="separator"></div>
                            <div class="row">
                                <div class="col jobOffer-description">
                                    <?php echo $jobOffer->getDescription() ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button name="<?php echo $jobOffer->getIdJobOffer() ?>" class="btn shadow-none button-blue width-100">Ver Publicacion</button>
                        </div> <!-- VER QUE HACER CON EL VER PUBLICACION -->
                    </div>
                <?php }
                }
            } else { ?>
                <div>
                    No hay publicaciones
                </div>
            <?php } ?>
        </div>
    </section>
</main>