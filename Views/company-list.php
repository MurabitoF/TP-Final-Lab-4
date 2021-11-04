<?php
require_once('verify-login.php');
require_once('nav.php');
require_once('header.php');

?>

<main>
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de empresas</h2>
               <?php
               if ($alert) {
               ?>
                    <div class="alert alert-<?php echo $alert->getType() ?> text-center fwbold" role="alert"><?php echo $alert->getMessage() ?></div>
               <?php
               }
               ?>
               <form action="<?php echo FRONT_ROOT ?>Company/ShowListView" method="post" class="bg-light-alpha p-5">
                    <div class="row align-item-center">
                         <div class="col-lg-5">
                              <div class="form-group">
                                   <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Nombre de la empresa" class="form-control form-input">
                              </div>
                         </div>
                         <div class="col-lg-5">
                              <div class="form-group">
                                   <input type="text" name="city" value="<?php echo $city; ?>" placeholder="City" class="form-control form-input">
                              </div>
                         </div>
                         <div class="col-lg-2">
                              <button type="submit" name="" class="btn col-lg-12 btn-dark ml-auto d-block">Buscar</button>
                         </div>
                    </div>
               </form>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>Ciudad</th>

                         <?php if ($_SESSION["loggedUser"]->getRole() == "Admin") { ?>
                              <th>Acciones</th>
                         <?php } ?>
                    </thead>
                    <tbody>
                         <form action="<?php echo FRONT_ROOT ?>Company/Action" method="get" class="bg-light-alpha p-5">
                              <?php
                              foreach ($companyList as $company) {
                                   if ($company->getState()) {
                              ?>
                                        <tr>
                                             <td><a href="<?php echo FRONT_ROOT ?>Company/ShowDataView?idCompany=<?php echo $company->getIdCompany() ?>"><?php echo $company->getName() ?></a></td>
                                             <td>
                                                  <?php foreach ($addressList as $address) {
                                                       if ($address->getIdCompany() == $company->getIdCompany()) {
                                                            echo $address->getCity();
                                                       }
                                                  } ?>
                                             </td>
                                             <td>
                                                  <?php
                                                  if ($_SESSION["loggedUser"]->getRole() == "Admin") {
                                                  ?>
                                                       <a class="btn button-black" href="<?php echo FRONT_ROOT ?>Company/ShowEditView?idCompany=<?php echo $company->getIdCompany() ?>"><i class="fas fa-pencil-alt"></i></a>
                                                       <a class="btn button-red" href="<?php echo FRONT_ROOT ?>Company/Remove?idCompany=<?php echo $company->getIdCompany() ?>"><i class="fas fa-trash-alt"></i></a>
                                             <?php
                                                  }
                                             }
                                             ?>
                                             </td>
                                        </tr>
                                   <?php
                              }
                                   ?>
                                   </tr>

                    </tbody>
               </table>
          </div>
     </section>
</main>

<?php
require_once('footer.php');
?>