<?php
require_once('header.php');
require_once('nav.php');
?>

<main class="py-5">
    <div class="container">
        <section id="jobOffer-post">
            <h1 class="jobOffer-title"><?php echo $jobOffer->getTitle() ?></h1>
            <div class="separator"></div>
            <?php if ($jobOffer->getExpireDate() < date('Y-m-d')) { ?>
                <section id="closed-tag">
                    <div class="alert alert-danger text-center fw-bold" role="alert">
                        Publicacion cerrada!
                    </div>
                </section>
            <?php } ?>
            <div class="row jobOffer-tags text-center my-3">
                <div class="col-md-4"><a href="<?php echo FRONT_ROOT . "Company/ShowDataView?idCompany=" . $company->getIdCompany(); ?>"><?php echo $company->getName() ?></a></div>
                <div class="col-md-4"><?php echo $jobPosition->getName() ?></div>
                <div class="col-md-4"><?php echo $jobOffer->getCity() ?></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php echo  nl2br($jobOffer->getDescription()) ?>
                </div>
            </div>
            <?php if($jobOffer->getImgFlyer()) ?>
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <img src="../<?php echo UPLOADS_PATH . 'img/flyer/' . $jobOffer->getImgFlyer()?>" alt="flyer" class="">
                </div>
            </div>
            <div class="row my-5">
                <div class="col-md-6">
                    <h3>Requerimientos</h3>
                    <?php echo  nl2br($jobOffer->getRequirements()) ?>
                </div>
                <div class="col-md-6  text-md-end">
                    <h3>Jornada Laboral</h3>
                    <?php echo $jobOffer->getWorkload() ?>
                </div>
            </div>
            <div class="row justify-content-between mt-3 jobOffer-tags mt-3">
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="jobOffer-date">Fecha de Publicacion</h5>
                        </div>
                        <div class="col-md-6">
                            <span><?php echo $jobOffer->getPostDate() ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 align-self-end">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="jobOffer-date">Fecha de Cierre</h5>
                        </div>
                        <div class="col-md-6">
                            <span><?php echo $jobOffer->getExpireDate() ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="separator"></div>
        <section id="applicant=form">
            <?php if ($jobOffer->getExpireDate() > date('Y-m-d')) {
                if ($_SESSION['loggedUser']->getRole() == "Student" && !array_key_exists($_SESSION['loggedUser']->getIdUser(), $jobOffer->getApplicants())) { ?>
                    <h2>Postulate</h2>
                    <?php if ($alert) { ?>
                        <div class="alert alert-<?php echo $alert->getType() ?> text-center fw-bold" role="alert">
                            <?php echo $alert->getMessage() ?>
                        </div>
                    <?php } ?>
                    <form action="<?php echo FRONT_ROOT ?>JobOffer/AddApplicant" enctype="multipart/form-data" method="POST">
                        <div class="visually-hidden">
                            <input type="text" name="idJobOffer" value="<?php echo $jobOffer->getIdJobOffer() ?>" readonly>
                            <input type="text" name="idUser" value="<?php echo $_SESSION['loggedUser']->getIdUser() ?>" readonly>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <textarea name="description" class="form-control form-textarea" placeholder="Una breve descripcion tuya"></textarea>
                            </div>
                        </div>
                        <div class="form row align-items-center my-5">
                            <div class="col-6 col-md-3">
                                <input type="file" name="fileCV" id="input-cv" class="form-control file-input" onchange="checkFile()" required>
                                <label class="btn button-blue w-100" for="input-cv">Subi tu CV <i class="fas fa-upload ms-3"></i></label>
                            </div>
                            <div class="col-1">
                                <i id="cv-upload-display" class="fas fa-check-circle visually-hidden"></i>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-md-4">

                                <button id="jobOffer-submit" type="submit" class="btn button-blue w-100" disabled>Postularme</button>
                            </div>
                        </div>
                    </form>
            <?php }
            }
            ?>
        </section>
    </div>
</main>

<script>
    let fileInput = document.getElementById("input-cv");
    let display = document.getElementById("cv-upload-display");
    let btnSubmit = document.getElementById("jobOffer-submit");

    function checkFile() {
        if (fileInput.files.length > 0) {
            display.classList.toggle('visually-hidden');
            btnSubmit.disabled = false;
        } else {
            display.classList.toggle('visually-hidden');
            btnSubmit.disabled = true;
        }
    }
</script>

<?php
require_once("footer.php");
?>