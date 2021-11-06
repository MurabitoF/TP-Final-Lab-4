<?php 
include('header.php');
include('nav.php');

?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4 text-center">Editar Publicación</h2> 
               <form action="<?php echo FRONT_ROOT ?>JobOffer/Edit" enctype="multipart/form-data" method="post" class="bg-light-alpha p-5">
                    <div class="row">
                         <div class="col-md-6">
                              <div class="form-group">
                                   <input type="text" name="title" class="form-control form-input" placeholder="Título de la publicación" value="<?php echo $jobOffer->getTitle();?>" required>      
                              </div>
                         </div>

                         <div class="col-md-3">
                              <div class="form-group">  
                                <select name="idCompany" class="form-control form-input" required>
                                   
                                <?php foreach($companyList as $company){
                                        if($company->getIdCompany() == $jobOffer->getCompany()){
                                             $nameCompany = $company->getName();
                                        }
                                      }
                                    ?>
                                
                                <option value="<?php echo $jobOffer->getCompany()?>" selected><?php echo $nameCompany ?></option>
                                    <?php foreach($companyList as $company){
                                             if($company->getIdCompany() != $jobOffer->getCompany()){?>
                                                  <option value="<?php echo $company->getIdCompany()?>"><?php echo $company->getName()?></option>
                                    <?php
                                             }
                                }?>
                                </select>
                              </div>
                         </div> 

                         <div class="col-md-3">
                              <div class="form-group">  
                                <select name="idJobPosition" class="form-control form-input" required>
                                   
                                <?php foreach($jobPositionList as $jobPosition){ 
                                        if($jobPosition->getIdJobPosition() == $jobOffer->getJobPosition()){
                                             $nameJobPosition = $jobPosition->getName();
                                        }
                                      }
                                    ?>

                                   <option value="<?php echo $jobOffer->getJobPosition()?>" selected><?php echo $nameJobPosition ?></option>
                                    <?php foreach($jobPositionList as $jobPosition){
                                             if($jobPosition->getIdJobPosition() != $jobOffer->getJobPosition()){?>
                                                  <option value="<?php echo $jobPosition->getIdJobPosition()?>"><?php echo $jobPosition->getName()?></option>
                                    <?php
                                        }
                                   }?>
                                </select>
                              </div>
                         </div> 
                         
                    </div>


                    <div class="row">
                         <div class="col-md-4">
                            <div class="form-group">
                                    <select name="city" class="form-control form-input" required>
                                        <option value="<?php echo $jobOffer->getCity()?>"><?php echo $jobOffer->getCity()?></option>
                                        <option value="Bahia Blanca">Bahia Blanca</option>
                                        <option value="Buenos Aires">Buenos Aires</option>
                                        <option value="Comodoro Rivadavia">Comodoro Rivadavia</option>
                                        <option value="Cordoba">Cordoba</option>
                                        <option value="Corrientes">Corrientes</option>
                                        <option value="Formosa">Formosa</option>
                                        <option value="La Plata">La Plata</option>
                                        <option value="Mar Del Plata">Mar del Plata</option>
                                        <option value="Mendoza">Mendoza</option>
                                        <option value="Neuquen">Neuquen</option>
                                        <option value="Parana">Parana</option>
                                        <option value="Posadas">Posadas</option>
                                        <option value="Resistencia">Resistencia</option>
                                        <option value="Rosario">Rosario</option>
                                        <option value="Salta">Salta</option>
                                        <option value="Tucuman">Tucuman</option>
                                    </select>
                            </div>
                         </div>

                         <div class="col-md-4">
                              <div class="form-group">  
                                <select name="idCareer" class="form-control form-input" required>

                                <?php foreach($careerList as $career){
                                        if($career->getIdCareer() == $jobOffer->getCareer()){
                                             $nameCareer = $career->getName();
                                        }
                                      }
                                    ?>

                                   <option value="<?php echo $jobOffer->getCareer()?>" selected><?php echo $nameCareer?></option>
                                    <?php foreach($careerList as $career){
                                         if($career->getIdCareer() != $jobOffer->getCareer()){?>
                                             <option value="<?php echo $career->getIdCareer()?>"><?php echo $career->getName()?></option>
                                    <?php
                                         }
                                }?>
                                </select>
                              </div>
                         </div> 

                         <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="workload" class="form-control form-input" placeholder="Carga Horaria" value="<?php echo $jobOffer->getWorkload()?>" required>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                              <div class="form-group">
                                    <textarea type="text" name = "requirements" class="form-control form-textarea" placeholder="Requerimientos" value="<?php echo $jobOffer->getRequirements()?>" required><?php echo $jobOffer->getRequirements()?></textarea>
                              </div>
                         </div>

                         <div class="col-md-6">
                              <div class="form-group">
                                    <textarea type="text" name = "description" class="form-control form-textarea" placeholder="Sobre la publicación" value="<?php echo $jobOffer->getDescription()?>" required><?php echo $jobOffer->getDescription()?></textarea>
                              </div>
                         </div>

                    </div>
                    <div class="row">
                         <div class="col-md-4">
                              <div class="form-group">
                                   <label for="">Fecha de Expiración</label>
                                   <input type="date" name="expireDate" class="form-control" value="<?php echo $jobOffer->getExpireDate()?>" required>
                              </div>
                         </div>
                        
                    </div>

                    <div class="row">
                         <input type="file" name="flyer" id="">
                    </div>

                    <div class="row mt-3 justify-content-end">
                         <div class="col-md-3">
                              <button type="submit" class="btn button-blue w-100" name="idJobOffer" value="<?php echo $jobOffer->getIdJobOffer() ?>">Editar</button>
                         </div>
                    </div> 

               </form>
          </div>
     </section>
</main>
