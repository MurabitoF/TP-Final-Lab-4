<?php
include('header.php');
include('nav.php');
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Publicaciones</h2>
               <form action="<?php echo FRONT_ROOT ?>JobOffer/ShowAdminListView" method="post">
                    <div class="row align-items-center">
                         <div class="col-md-3">
                              <div class="form-group">  
                                <select name="idCareer" class="form-control form-input">
                                   <option value="" selected>Carrera</option>
                                    <?php foreach($careerList as $career){?>
                                        <option value="<?php echo $career->getIdCareer()?>"><?php echo $career->getName()?></option>
                                    <?php
                                }?>
                                </select>
                              </div>
                         </div> 

                         <div class="col-md-3">
                              <div class="form-group">  
                                <select name="idJobPosition" class="form-control form-input">
                                   <option value="" selected>Posición de Trabajo</option>
                                    <?php foreach($jobPositionList as $jobPosition){?>
                                        <option value="<?php echo $jobPosition->getIdJobPosition()?>"><?php echo $jobPosition->getName()?></option>
                                    <?php
                                }?>
                                </select>
                              </div>
                         </div> 

                         <div class="col-lg-3">
                              <div class="form-group">
                                   <input type="text" name="workload" value="" placeholder="Carga horaria" class="form-control form-input">
                              </div>
                         </div>

                         <div class="col-lg-3">
                              <div class="form-group">
                                   <input type="text" name="city" value="" placeholder="Ciudad" class="form-control form-input">
                              </div>
                         </div>
                         <div class="col-lg-2">
                              <button type="submit" class="btn button-blue w-100">Buscar</button>
                         </div>
                    </div>
               </form>


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
              
                                   <?php foreach($companyList as $company){ ///FOREACH FEO PARA MOSTRAR NOMBRE DE CAREER
                                        if($company->getIdCompany() == $jobOffer->getCompany()){
                                             $nameCompany = $company->getName();
                                        }
                                      }
                                   ?>
                                   <td><?php echo $nameCompany ?></td>

                                   <?php foreach($careerList as $career){ ///FOREACH FEO PARA MOSTRAR NOMBRE DE CAREER
                                        if($career->getIdCareer() == $jobOffer->getCareer()){
                                             $nameCareer = $career->getName();
                                        }
                                      }
                                    ?>                    
                                   <td><?php echo $nameCareer; ?></td>
                                   
                                   <td><?php echo $jobOffer->getCity(); ?></td>

                                   <?php foreach($jobPositionList as $jobPosition){ ///FOREACH FEO PARA MOSTRAR NOMBRE DE JOB POSITION
                                        if($jobPosition->getIdJobPosition() == $jobOffer->getJobPosition()){
                                             $nameJobPosition = $jobPosition->getName();
                                        }
                                      }
                                    ?>


                                   <td><?php echo $nameJobPosition; ?></td>
                                   <td><?php echo $jobOffer->getPostDate(); ?></td>
                                   <td>
                                        <a href="<?php echo FRONT_ROOT . "JobOffer/Remove?idJobOffer=" . $jobOffer->getIdJobOffer(); ?>" class="btn button-red"><i class="fas fa-trash-alt"></i></a>
                                        <a href="<?php echo FRONT_ROOT . "JobOffer/ShowEditView?idJobOffer=" . $jobOffer->getIdJobOffer(); ?>" class="btn button-black"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="<?php echo FRONT_ROOT . "JobOffer/ =" . $jobOffer->getIdJobOffer(); ?>" class="btn button-blue"><i class="fas fa-pencil-alt"></i></a>
                                   </td>
                              </tr>
                         <?php
                         }
                         ?>
                    </tbody>
               </table>
          </div>
     </section>
</main>