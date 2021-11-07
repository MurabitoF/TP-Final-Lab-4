<?php
require_once('verify-login.php');
require_once('nav.php');
require_once('header.php');

?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Aplicantes</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Fecha</th>
                         <th>Cv</th>
                         <th>Descipcion</th>
                    </thead>
                    <tbody>
                         <?php
                         foreach ($applicantList as $applicant) {
                         ?>
                              <tr>        
                                    <td><?php echo $applicant->getDate(); ?></td>
                                    <td><?php echo $applicant->getCv(); ?></td>
                                    <td><?php echo $applicant->getDescription(); ?></td>
                              </tr>
                         <?php
                         }
                         ?>
                    </tbody>
               </table>
          </div>
     </section>
</main>