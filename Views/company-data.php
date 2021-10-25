<?php
require_once('verify-login.php');
require_once('nav.php');
require_once('header.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Datos de la empresa</h2>
               <table class="table bg-light-alpha">
                    <tbody>
                         <tr>
                              <th>ID</th>
                             <td><?php echo $company->getIdCompany()?></td>
                         </tr>
                         <tr>
                              <th>Nombre</th>
                              <td><?php echo $company->getName() ?></td>
                         </tr>
                         <tr>
                              <th>Ciudad de la sucursal</th>
                              <td><?php echo $company->getCity() ?></td>
                         </tr>
                         <tr>
                              <th>Categoria</th>
                              <td><?php echo $career->getName(); ?></td>
                         </tr>
                         <tr>
                              <th>Descripción</th>
                              <td><?php echo $company->getDescription() ?></td>
                         </tr>
                         <tr>
                              <th>Dirección de la sucursal</th>
                              <td><?php echo $company->getStreet(). " " .$company->getStreetAddress() ?></td>
                         </tr>
                         <tr>
                              <th>Código Postal</th>
                              <td><?php echo $company->getPostalCode() ?></td>
                         </tr>
                    </tbody>
               </table>
          </div>
     </section>
</main>