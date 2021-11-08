<?php
//require_once('verify-login.php');
require_once('nav.php');
require_once('header.php');

?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Postulantes</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>Apellido</th>
                         <th>Email</th>
                         <th>Telefono</th>
                         <th>Fecha</th>
                         <th>Cv</th>
                         <th>Descripción</th>
                    </thead>
                    <tbody>
                         <?php
                         foreach ($applicantList as $applicant) {
                         ?>
                              <tr> 
                                   <?php foreach($studentList as $student){
                                             if($student->getStudentId() == $applicant->getIdUser()){
                                                  ?>
                                    <td><?php echo $student->getFirstName(); ?></td>
                                    <td><?php echo $student->getLastName(); ?></td>
                                    <td><?php echo $student->getEmail(); ?></td>
                                    <td><?php echo $student->getPhoneNumber(); ?></td>                  
                                    <td><?php echo $applicant->getDate(); ?></td>
                                    <td><?php echo $applicant->getCv(); ?></td>
                                    <td><?php echo $applicant->getDescription(); ?></td>
                              </tr>
                                   <?php
                                             }
                                        }
                         }
                         ?>
                    </tbody>
               </table>
          </div>
     </section>
</main>