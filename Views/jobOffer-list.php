<?php
//require_once('verify-login.php');
require_once('header.php');
require_once('nav.php');

?>

<main class="py-3">
    <section id="jobOffer-list">
        <div class="container">
            <h2>Historial de Postulaciones</h2>

            <?php if ($lastApplications) {
                        foreach ($lastApplications as $application) { 
                            $jobOffer = $this->jobOfferDAO->SearchId($application);?>
                            <div class="row align-items-center justify-content-around jobOffer-card pt-2">
                                <div class="col-md-8 jobOffer-info">
                                    <h2><?php echo $jobOffer->getTitle() ?></h2>
                                    <div class="row justify-content-start jobOffer-tags">                   
                                        
                                    <?php foreach($companyList as $company){ ///FOREACH FEO PARA MOSTRAR NOMBRE DE COMPANY
                                        if($company->getIdCompany() == $jobOffer->getCompany()){
                                             $nameCompany = $company->getName();
                                        }
                                      }
                                    ?>

                                    <div class="col-sm-2"><?php echo $nameCompany?></a></div>

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
                                    <a href="<?php echo FRONT_ROOT . "JobOffer/ShowPostView?idJobOffer=" . $jobOffer->getIdJobOffer() ?>" class="btn button-blue width-100">Ver Publicacion</a>
                                    </div>
                                   
                        </div>
                            
                              <?php }
                         } else { ?>
                              <h4>No tenes ninguna postulacion</h4>
                         <?php } ?> 
        </div>
    </section>
</main>