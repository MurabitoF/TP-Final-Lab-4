<?php
require_once('nav.php');
$loggedUser = $_SESSION['loggedUser']
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Datos del alumno</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>ID</th>
                         <th>Legajo</th>
                         <th>Nombre</th>
                         <th>Apellido</th>
                         <th>DNI</th>
                         <th>ID Carrera</th>
                         <th>Genero</th>
                         <th>Fecha de nacimiento</th>
                         <th>Email</th>
                         <th>Nro Telefono</th>
                         <th>Estado</th>
                    </thead>
                    <tbody>
                         <tr>
                              <td><?php echo $loggedUser->getStudentId() ?></td>
                              <td><?php echo $loggedUser->getFileNumber() ?></td>
                              <td><?php echo $loggedUser->getFirstName() ?></td>
                              <td><?php echo $loggedUser->getLastName() ?></td>
                              <td><?php echo $loggedUser->getDni() ?></td>
                              <td><?php echo $loggedUser->getCareerId() ?></td>
                              <td><?php echo $loggedUser->getGender() ?></td>
                              <td><?php echo $loggedUser->getBirthDate() ?></td>
                              <td><?php echo $loggedUser->getEmail() ?></td>
                              <td><?php echo $loggedUser->getPhoneNumber() ?></td>
                              <td><?php echo var_dump($loggedUser->getState()) ?></td>
                         </tr>
                    </tbody>
               </table>
          </div>
     </section>
</main>