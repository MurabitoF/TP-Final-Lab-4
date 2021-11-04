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
                         <th>Carga Horaria</th>
                         <th>Fecha de ingreso</th>
                         <th>Acciones</th>
                    </thead>
                    <tbody>
                         <?php
                         foreach ($jobOfferList as $jobOffer) {
                         ?>
                              <tr>
                                   <td><a href="<?php echo FRONT_ROOT."JobOffer/ShowPostView?idJobOffer=".$jobOffer->getIdJobOffer();?>"><?php echo $jobOffer->getTitle(); ?></a></td>
                                   <td><?php echo $jobOffer->getCareer(); ?></td>
                                   <!--modificado category por career-->
                                   <td><?php echo $jobOffer->getCompany(); ?></td>
                                   <td><?php echo $jobOffer->getCity(); ?></td>
                                   <td><?php echo $jobOffer->getJobPosition(); ?></td>
                                   <td><?php echo $jobOffer->getWorkload(); ?></td>
                                   <td><?php echo $jobOffer->getPostDate(); ?></td>
                                   <td>
                                        <a href="<?php echo FRONT_ROOT."JobOffer/Remove?idJobOffer=".$jobOffer->getIdJobOffer(); ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                        <a href="<?php echo FRONT_ROOT."JobOffer/ShowEditView?idJobOffer=".$jobOffer->getIdJobOffer(); ?>" class="btn btn-danger"><i class="fas fa-pencil-alt"></i></a>
                                   </td><!-- tener en cuenta el boton de eliminar -->
                              </tr>
                         <?php
                         }
                         ?>
                    </tbody>
               </table>
          </div>
     </section>
</main>