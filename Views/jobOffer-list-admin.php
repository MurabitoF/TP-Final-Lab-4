<?php
include('header.php');
include('nav.php');

?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Publicaciones</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Titulo</th>
                         <th>Carrera</th>
                         <th>Empresa</th>
                         <th>Ciudad</th>
                         <th>Posicion</th>
                         <th>Requerimientos</th>
                         <th>Carga Horaria</th>
                         <th>Fecha de ingreso</th>
                         <th>Descripcion</th>
                    </thead>
                    <tbody>
                    <form action="" method="POST"> <!--si a futuro quiero eliminar desde aca hago un metodo-->
                         <?php
                              foreach($jobOfferList as $jobOffer){
                                        ?>
                                             <tr>
                                                  <td><?php echo $jobOffer->getTitle(); ?></td>
                                                  <td><?php echo $jobOffer->getCareer(); ?></td><!--modificado category por career-->
                                                  <td><?php echo $jobOffer->getCompany(); ?></td>
                                                  <td><?php echo $jobOffer->getCity(); ?></td>
                                                  <td><?php echo $jobOffer->getJobPosition(); ?></td>
                                                  <td><?php echo $jobOffer->getRequirements(); ?></td>
                                                  <td><?php echo $jobOffer->getWorkload(); ?></td>
                                                  <td><?php echo $jobOffer->getIncome(); ?></td>
                                                  <td><?php echo $jobOffer->getDescription(); ?></td>
                                                  <td> 
                                                       <button type="submit" name="btnRemove" class="btn btn-danger" value=""> Eliminar </button>
                                                  </td><!-- tener en cuenta el boton de eliminar -->
                                             </tr>
                                        <?php
                                   }
                         ?>
                         </form>
                    </tbody>
               </table>
          </div>
     </section>
</main>
