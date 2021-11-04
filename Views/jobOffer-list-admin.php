<?php
include('header.php');
include('nav.php');
///MODIFICADO PARA ADMIN Y STUDENT
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Publicaciones</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Titulo</th>
                         <th>Carrera</th>
                         <th>Ciudad</th>
                         <th>Posicion</th>
                         <th>Fecha de publicación</th>
                         <th>Carga Horaria</th>
                         <th>Acciones</th>
                    </thead>
                    <tbody>
                         <form action="<?php echo FRONT_ROOT ?>JobOffer/Action" method="POST">
                              <?php
                              foreach ($jobOfferList as $jobOffer) {
                                   if ($jobOffer->getActive()) {

                              ?>
                                        <tr>
                                             <td><?php echo $jobOffer->getTitle(); ?></td>

                                             <?php foreach ($careerList as $career) {
                                                  if ($career->getIdCareer() == $jobOffer->getCareer()) {
                                             ?>
                                                       <td><?php echo $career->getName(); ?></td>
                                             <?php
                                                  }
                                             }
                                             ?>

                                             <td><?php echo $jobOffer->getCity(); ?></td>

                                             <?php foreach ($jobPositionList as $jobPosition) {
                                                  if ($jobPosition->getIdJobPosition() == $jobOffer->getJobPosition()) {
                                             ?>
                                                       <td><?php echo $jobPosition->getName(); ?></td>
                                             <?php
                                                  }
                                             }
                                             ?>
                                             <td><?php echo $jobOffer->getPostDate(); ?></td>
                                             <td><?php echo $jobOffer->getWorkload(); ?></td>

                                             <td>
                                                  <button type="submit" name="Remove" class="btn btn-danger" value="<?php echo $jobOffer->getIdJobOffer() ?> "><i class="fas fa-trash-alt"></i></button>
                                                  <button type="submit" name="Edit" class="btn btn-dark" value="<?php echo $jobOffer->getIdJobOffer() ?> "><i class="fas fa-pencil-alt"></i></button>
                                             </td>
                                        </tr>
                              <?php
                                   }
                              }
                              ?>
                         </form>
                    </tbody>
               </table>
          </div>
     </section>
</main>