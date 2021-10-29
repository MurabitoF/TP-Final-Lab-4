<?php
require_once('verify-login.php');
require_once('nav.php');
require_once('header.php');

?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de empresas</h2>
               <form action="<?php echo FRONT_ROOT ?>Company/ShowListView" method="post" class="bg-light-alpha p-5">
                    <div class="row">
                         <div class="col-lg-6">
                              <div class="form-group">
                                   <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Nombre de la empresa" class="form-control form-input">
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
                                   <select name="category" class="form-select">
                                        <option value="" selected>Categoria</option>
                                        <?php
                                        foreach ($careerList as $career) {
                                             if ($career->getActive()) {
                                        ?>
                                                  <option value="<?php echo $career->getIdCareer() ?>" <?php if ($category == $career->getName()) echo 'selected'; ?>><?php echo $career->getName() ?></option>
                                        <?php
                                             }
                                        }
                                        ?>
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
                         <th>Acciones</th>
                    </thead>
                    <tbody>
                         <form action="<?php echo FRONT_ROOT ?>Company/Action" method="post" class="bg-light-alpha p-5">
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
                                             <td><?php echo $company->getCategory() ?></td>
                                             <td>
                                                  <button type="submit" name="getData" class="btn btn-dark" value="<?php echo $company->getIdCompany() ?>">Ver datos</i></button>
                                                  <?php
                                                  if ($_SESSION["loggedUser"]->getRole() == "Admin") {
                                                  ?>
                                                       <button type="submit" name="Remove" class="btn btn-danger" value="<?php echo $company->getIdCompany() ?>"><i class="fas fa-trash-alt"></i></button>
                                                       <button type="submit" name="Edit" class="btn btn-dark" value="<?php echo $company->getIdCompany() ?>"><i class="fas fa-pencil-alt"></i></button>
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