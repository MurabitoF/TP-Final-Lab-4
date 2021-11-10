<?php
//require_once('verify-login.php');
require_once('nav.php');
require_once('header.php');

?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div id="applicantsTable" class="container">
               <h2 class="mb-4">Listado de Postulantes</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>Apellido</th>
                         <th>Email</th>
                         <th>Telefono</th>
                         <th>Fecha</th>
                         <th>Descripción</th>
                    </thead>
                    <tbody>
                         <?php
                         foreach ($applicantList as $applicant) {
                         ?>
                              <tr>
                                   <?php foreach ($studentList as $student) {
                                        if ($student->getStudentId() == $applicant->getIdUser()) {
                                   ?>
                                             <td><?php echo $student->getFirstName(); ?></td>
                                             <td><?php echo $student->getLastName(); ?></td>
                                             <td><?php echo $student->getEmail(); ?></td>
                                             <td><?php echo $student->getPhoneNumber(); ?></td>
                                             <td><?php echo $applicant->getDate(); ?></td>
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
          <div class="containier mb-5">
               <a class="btn button-black" href="javascript:saveToPdf()">Download list</a>
          </div>
     </section>
</main>

<script>
     function saveToPdf() {

          var opt = {
               margin: 5,
               filename: 'applicants.pdf',
               enableLinks: false,
               html2canvas:  {
                    scale: 5,
                    width: 890,
                    height: 1000,
                    scrollY: 0,
                    orientation: 'portrait'
               },
               jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
               },
               pagebreak: {avoid:'tr'}
          };

          var element = document.getElementById('applicantsTable');

          html2pdf().set(opt).from(element).save();
     }
</script>