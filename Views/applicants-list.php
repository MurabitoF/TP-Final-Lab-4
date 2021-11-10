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
                         <th>Email</th>
                         <th>Telefono</th>
                         <th>Fecha</th>
                         <th>Descripción</th>
                         <th data-html2canvas-ignore="true">Acciones</th>
                    </thead>
                    <tbody>
                         <?php
                         foreach ($applicantList as $applicant) {
                              if ($applicant->getActive()) {
                         ?>
                                   <tr>
                                        <?php foreach ($studentList as $student) {
                                             if ($student->getStudentId() == $applicant->getIdStudent()) { ///CAMBIO PARA QUE MUESTRE APELLIDO, NOMBRE
                                        ?>
                                                  <td><?php echo $student->getLastName() . ", " . $student->getFirstName(); ?></td>

                                                  <td><?php echo $student->getEmail(); ?></td>
                                                  <td><?php echo $student->getPhoneNumber(); ?></td>
                                                  <td><?php echo $applicant->getDate(); ?></td>
                                                  <td><?php echo $applicant->getDescription(); ?></td>

                                                  <td data-html2canvas-ignore="true">
                                                       <a href="<?php echo FRONT_ROOT . "JobOffer/RemoveApplicant?idStudent=" . $applicant->getIdStudent() . "&idUser_Has_JobOffer=" . $applicant->getIdApplicant() . "&idJobOffer=" . $applicant->getIdJobOffer(); ?>" class="btn button-red w-100" data-bs-toggle="tooltip" title="Borrar Postulante">
                                                            <i class="fas fa-trash-alt"></i>
                                                       </a>
                                                  </td>
                                   </tr>
               <?php
                                             }
                                        }
                                   }
                              }
               ?>
                    </tbody>
               </table>
               <div class="containier mb-5" data-html2canvas-ignore="true">
                    <a class="btn button-black" href="javascript:saveToPdf()">Download PDF <i class="fas fa-file-pdf"></i></a>
                    <a class="btn button-blue" href="<?php echo FRONT_ROOT . "JobOffer/DownloadCVsFromJobOffer?idJobOffer=" . $idJobOffer; ?>" title="Descargar CV">
                         Download CV <i class="fas fa-file-archive"></i></a>
               </div>
          </div>
     </section>
</main>

<script>
     function saveToPdf() {

          var opt = {
               margin: 5,
               filename: 'applicants_<?php echo $idJobOffer ?>.pdf',
               enableLinks: false,
               html2canvas: {
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
               pagebreak: {
                    avoid: 'tr'
               }
          };

          var element = document.getElementById('applicantsTable');

          html2pdf().set(opt).from(element).save();
     }
</script>