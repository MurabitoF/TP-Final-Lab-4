<?php
require_once('header.php');
require_once('nav.php');
?>

<main class="py-3">
    <section id="jobOffer-list-student">
        <div class="container">
            <h2>Listado de Publicaciones</h2>
            <form action="<?php echo FRONT_ROOT ?>JobOffer/ShowStudentListView" method="post">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="idCareer" class="form-control form-input">
                                <option value="" selected>Carrera</option>
                                <?php foreach ($careerList as $career) { ?>
                                    <option value="<?php echo $career->getIdCareer() ?>"><?php echo $career->getName() ?></option>
                                <?php
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="idJobPosition" class="form-control form-input">
                                <option value="" selected>Posición de Trabajo</option>
                                <?php foreach ($jobPositionList as $jobPosition) { ?>
                                    <option value="<?php echo $jobPosition->getIdJobPosition() ?>"><?php echo $jobPosition->getName() ?></option>
                                <?php
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" name="city" value="" placeholder="Ciudad" class="form-control form-input">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" name="workload" value="" placeholder="Carga horaria" class="form-control form-input">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn button-blue w-100">Buscar</button>
                    </div>
                </div>
            </form>
            <div class="separator mt-1"></div>
            <?php if (!empty($jobOfferList)) {
                foreach ($jobOfferList as $jobOffer) {
                    if ($jobOffer->getActive()) { ?>
                        <div class="row align-items-center justify-content-around jobOffer-card pt-2">
                            <div class="col-md-8 jobOffer-info">
                                <h2><?php echo $jobOffer->getTitle() ?></h2>
                                <div class="row justify-content-start jobOffer-tags">
                                    <?php foreach ($companyList as $company) { ///FOREACH FEO PARA MOSTRAR NOMBRE DE COMPANY
                                        if ($company->getIdCompany() == $jobOffer->getCompany()) {
                                            $nameCompany = $company->getName();
                                        }
                                    }
                                    ?>

                                    <div class="col-sm-2"><?php echo $nameCompany ?></a></div>

                                    <?php foreach ($jobPositionList as $jobPosition) { ///FOREACH FEO PARA MOSTRAR NOMBRE DE JOB POSITION
                                        if ($jobPosition->getIdJobPosition() == $jobOffer->getJobPosition()) {
                                            $nameJobPosition = $jobPosition->getName();
                                        }
                                    }
                                    ?>

                                    <div class="col-sm-3"><?php echo $nameJobPosition ?></div>
                                    <div class="col-sm-2"><?php echo $jobOffer->getCity() ?></div>
                                </div>
                                <div class="row jobOffer-tags">

                                    <?php foreach ($careerList as $career) { ///FOREACH FEO PARA MOSTRAR NOMBRE DE CAREER
                                        if ($career->getIdCareer() == $jobOffer->getCareer()) {
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
                }
            } else { ?>
                <div>
                    No hay publicaciones
                </div>
            <?php } ?>
        </div>
    </section>
</main>