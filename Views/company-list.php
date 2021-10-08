<?php

require_once('nav.php');
require_once('header.php');

session_start();

?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de empresas</h2>
               <form action="<?php echo FRONT_ROOT ?>Company/ShowListView" method="post" class="bg-light-alpha p-5">
                    <div class="row">
                         <div class="col-lg-6">
                              <div class="form-group">
                                   <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Nombre de la empresa" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-6">
                              <div class="form-group">
                                   <input type="text" name="city" value="<?php echo $city; ?>" placeholder="City" class="form-control">
                              </div>
                         </div>
                    </div>
                    <div class="row">
                         <div class="col-lg-6">
                              <div class="form-group">
                                   <select name="category" class="form-control">
                                        <option value="" selected>Categoria</option>
                                        <option value="Ingenieria" <?php if ($category == "Ingenieria") {
                                                                           echo 'selected';
                                                                      } ?>>Ingenieria</option>
                                        <option value="Programacion" <?php if ($category == "Programacion") {
                                                                           echo 'selected';
                                                                      } ?>>Programacion</option>
                                        <option value="Agriculcura" <?php if ($category == "Agriculcura") {
                                                                           echo 'selected';
                                                                      } ?>>Agriculcura</option>
                                        <option value="Seguridad e Higiene" <?php if ($category == "Seguridad e Higiene") {
                                                                                     echo 'selected';
                                                                                } ?>> Seguridad e Higiene</option>
                                   </select>
                              </div>
                         </div>
                         <div class="col-lg-6">
                              <button type="submit" name="" class="btn col-lg-12 btn-dark ml-auto d-block">Buscar</button>
                         </div>
                    </div>
               </form>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>Ciudad</th>
                         <th>Categoria</th>
                         <?php
                         if ($_SESSION["loggedUser"]->getRole() == "Admin") {
                              echo "<th>Acciones</th>";
                         }
                         ?>
                    </thead>
                    <tbody>
                         <form action="<?php echo FRONT_ROOT ?>Company/Action" method="post" class="bg-light-alpha p-5">
                              <?php
                              foreach ($companyList as $company) {
                              ?>
                                   <tr>
                                        <td><?php echo $company->getName() ?></td>
                                        <td><?php echo $company->getCity() ?></td>
                                        <td><?php echo $company->getCategory() ?></td>
                                        <?php
                                        if ($_SESSION["loggedUser"]->getRole() == "Admin") {
                                        ?>
                                             <td>
                                                  <button type="submit" name="Remove" class="btn btn-danger" value="<?php echo $company->getIdCompany() ?>"><i class="fas fa-trash-alt"></i></button>
                                                  <button type="submit" name="Edit" class="btn btn-dark" value="<?php echo $company->getIdCompany() ?>"><i class="fas fa-pencil-alt"></i></button>
                                             </td>
                                        <?php
                                        }
                                        ?>
                                   </tr>
                              <?php
                              }
                              ?>
                              </tr>
                         </form>
                    </tbody>
               </table>
          </div>
     </section>
</main>