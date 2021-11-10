<?php
include('header.php');
include('nav.php');
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Publicaciones</h2>
               <?php
               if ($alert) {
               ?>
                    <div class="alert alert-<?php echo $alert->getType() ?> text-center fwbold" role="alert"><?php echo $alert->getMessage() ?></div>
               <?php
               }
               ?>
               <form action="<?php echo FRONT_ROOT ?>JobOffer/ShowAdminListView" method="post">
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
                                   <input type="text" name="workload" value="" placeholder="Carga horaria" class="form-control form-input">
                              </div>
                         </div>

                         <div class="col-md-2">
                              <div class="form-group">
                                   <input type="text" name="city" value="" placeholder="Ciudad" class="form-control form-input">
                              </div>
                         </div>
                         <div class="col-md-1">
                              <button type="submit" class="btn button-black w-100">Buscar</button>
                         </div>
                    </div>
               </form>

               <?php if ($jobOfferList) { ?>
                    <table class="table bg-light-alpha">
                         <thead>
                              <th>Titulo</th>
                              <th>Compania</th>
                              <th>Carrera</th>
                              <th>Ciudad</th>
                              <th>Posicion</th>
                              <th>Fecha de Publicacion</th>
                              <th>Acciones</th>
                         </thead>
                         <tbody>
                              <?php
                              foreach ($jobOfferList as $jobOffer) {
                              ?>
                                   <tr>
                                        <td>
                                             <a class="link-button" href="<?php echo FRONT_ROOT . "JobOffer/ShowPostView?idJobOffer=" . $jobOffer->getIdJobOffer(); ?>">
                                                  <?php echo $jobOffer->getTitle(); ?>
                                             </a>
                                        </td>

                                        <?php if (is_array($companyList)) {
                                             foreach ($companyList as $company) {
                                                  if ($company->getIdCompany() == $jobOffer->getCompany()) {
                                                       $nameCompany = $company->getName();
                                                  }
                                             }
                                        } else {
                                             $nameCompany = $companyList->getName();
                                        }
                                        ?>
                                        <td><?php echo $nameCompany ?></td>

                                        <?php foreach ($careerList as $career) {
                                             if ($career->getIdCareer() == $jobOffer->getCareer()) {
                                                  $nameCareer = $career->getName();
                                             }
                                        }
                                        ?>
                                        <td><?php echo $nameCareer; ?></td>

                                        <td><?php echo $jobOffer->getCity(); ?></td>

                                        <?php foreach ($jobPositionList as $jobPosition) {
                                             if ($jobPosition->getIdJobPosition() == $jobOffer->getJobPosition()) {
                                                  $nameJobPosition = $jobPosition->getName();
                                             }
                                        }
                                        ?>
                                        <td><?php echo $nameJobPosition; ?></td>
                                        <td><?php echo $jobOffer->getPostDate(); ?></td>
                                        <td>
                                             <div class="dropend ">
                                                  <button type="button" class="btn button-blue w-100 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                  </button>
                                                  <div class="dropdown-menu p-0">
                                                       <div class="row action-buttons">
                                                            <div class="col-6">
                                                                 <a href="<?php echo FRONT_ROOT . "JobOffer/ShowEditView?idJobOffer=" . $jobOffer->getIdJobOffer(); ?>" class="btn button-black w-100" data-bs-toggle="tooltip" title="Editar Publicacion">
                                                                      <i class="fas fa-pencil-alt"></i>
                                                                 </a>
                                                            </div>
                                                            <div class="col-6">
                                                                 <a href="<?php echo FRONT_ROOT . "JobOffer/ShowApplicantListView?idJobOffer=" . $jobOffer->getIdJobOffer(); ?>" class="btn button-blue w-100" data-bs-toggle="tooltip" title="Ver Postulantes">
                                                                      <i class="fas fa-user-graduate"></i>
                                                                 </a>
                                                            </div>
                                                       </div>
                                                       <div class="row action-buttons">
                                                            <div class="col-6">
                                                                 <a href="<?php echo FRONT_ROOT . "JobOffer/CloseJobOffer?idJobOffer=" . $jobOffer->getIdJobOffer(); ?>" class="btn button-yellow w-100" data-bs-toggle="tooltip" title="Cerrar Publicacion">
                                                                      <i class="fas fa-times"></i>
                                                                 </a>
                                                            </div>
                                                            <div class="col-6">
                                                                 <a href="<?php echo FRONT_ROOT . "JobOffer/Remove?idJobOffer=" . $jobOffer->getIdJobOffer(); ?>" class="btn button-red w-100" data-bs-toggle="tooltip" title="Borrar Publicacion">
                                                                      <i class="fas fa-trash-alt"></i>
                                                                 </a>
                                                            </div>

                                                       </div>

                                                  </div>
                                        </td>
                                   </tr>
                              <?php
                              }
                              ?>

                         </tbody>
                    </table>
               <?php } else { ?>
                    <h4>No hay publicaciones</h4>
               <?php } ?>
          </div>
     </section>
</main>
<script src="../<?php echo VIEWS_PATH ?>js/bootstrap.bundle.min.js"></script>