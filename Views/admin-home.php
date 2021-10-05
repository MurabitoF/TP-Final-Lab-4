<?php

require_once('nav.php');
require_once('header.php');

?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de empresas</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>Ciudad</th>
                         <th>Categoria</th>
                    </thead>
                    <tbody>
                    <form action="<?php echo FRONT_ROOT ?>Company/Action" method="post" class="bg-light-alpha p-5">
                         <?php
                              foreach($companyList as $company)
                              {
                                   ?>
                                        <tr>
                                            <td><?php echo $company->getName() ?></td>
                                            <td><?php echo $company->getCity() ?></td>
                                            <td><?php echo $company->getCategory() ?></td>
                                            <td><button type="submit" name="Remove" class="btn btn-danger" value="<?php echo $company->getIdCompany()?>">Remover</button></td>
                                            <td><button type="submit" name="Edit" class="btn btn-dark" value="<?php echo $company->getIdCompany()?>">Editar</button></td>
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