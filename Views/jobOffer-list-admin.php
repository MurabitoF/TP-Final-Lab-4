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
                         <th>Compania</th>
                         <th>Ciudad</th>
                         <th>Posicion</th>
                         <th>Carga Horaria</th>
                         <th>Fecha Publicacion</th>
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
                                   <td><?php echo $jobOffer->getCareer(); ?></td>
                                   <td><?php echo $jobOffer->getCompany(); ?></td>
                                   <td><?php echo $jobOffer->getCity(); ?></td>
                                   <td><?php echo $jobOffer->getJobPosition(); ?></td>
                                   <td><?php echo $jobOffer->getWorkload(); ?></td>
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