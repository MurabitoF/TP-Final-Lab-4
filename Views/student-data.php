<?php
require_once('nav.php');
session_start();
$loggedUser = $_SESSION['loggedUser'];
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Datos del alumno</h2>
               <table class="table bg-light-alpha">
                    <tbody>
                         <tr>
                              <th>ID</th>
                              <td><?php echo $loggedUser->getStudentId() ?></td>
                         </tr>
                         <tr>
                              <th>Legajo</th>
                              <td><?php echo $loggedUser->getFileNumber() ?></td>
                         </tr>
                         <tr>
                              <th>Nombre</th>
                              <td><?php echo $loggedUser->getFirstName() ?></td>
                         </tr>
                         <tr>
                              <th>Apellido</th>
                              <td><?php echo $loggedUser->getLastName() ?></td>
                         </tr>
                         <tr>
                              <th>DNI</th>
                              <td><?php echo $loggedUser->getDni() ?></td>
                         </tr>
                         <tr>
                              <th>ID Carrera</th>
                              <td><?php echo $loggedUser->getCareerId() ?></td>
                         </tr>
                         <tr>
                              <th>Genero</th>
                              <td><?php echo $loggedUser->getGender() ?></td>
                         </tr>
                         <tr>
                              <th>Fecha de nacimiento</th>
                              <td><?php echo $loggedUser->getBirthDate() ?></td>
                         </tr>
                         <tr>
                              <th>Email</th>
                              <td><?php echo $loggedUser->getEmail() ?></td>
                         </tr>
                         <tr>
                              <th>Nro Telefono</th>
                              <td><?php echo $loggedUser->getPhoneNumber() ?></td>
                         </tr>
                         <tr>
                              <th>Estado</th>
                              <td><?php echo var_dump($loggedUser->getState()) ?></td>
                         </tr>
                    </tbody>
               </table>
          </div>
     </section>
</main>