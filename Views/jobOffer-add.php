<?php 
include('header.php');
include('nav.php');

?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4 text-center">Agregar Publicación</h2>
               <div class="separator"></div>
               <?php if($alert){ ?>
                    <div class="alert alert-<?php echo $alert->getType()?> text-center fwbold" role="alert"><?php echo $alert->getMessage()?></div>
               <?php } ?>
               <form action="<?php echo FRONT_ROOT ?>JobOffer/Add" enctype="multipart/form-data" method="post" class="bg-light-alpha p-5">
                    <div class="row">
                         <div class="col-md-6">
                              <div class="form-group">
                                   <input type="text" name="title" class="form-control form-input" placeholder="Título de la publicación" required>      
                              </div>
                         </div>

                         <div class="col-md-3">
                              <div class="form-group">  
                                <select name="idCompany" class="form-select form-input" required>
                                   <option value="" selected>Empresa</option>
                                    <?php foreach($companyList as $company){?>
                                        <option value="<?php echo $company->getIdCompany()?>"><?php echo $company->getName()?></option>
                                    <?php
                                }?>
                                </select>
                              </div>
                         </div> 

                         <div class="col-md-3">
                              <div class="form-group">  
                                <select name="idJobPosition" class="form-select form-input" required>
                                   <option value="" selected>Posición de Trabajo</option>
                                    <?php foreach($jobPositionList as $jobPosition){?>
                                        <option value="<?php echo $jobPosition->getIdJobPosition()?>"><?php echo $jobPosition->getName()?></option>
                                    <?php
                                }?>
                                </select>
                              </div>
                         </div> 
                             
                    </div>


                    <div class="row">
                         <div class="col-md-4">
                            <div class="form-group">
                                    <select name="city" class="form-select form-input" required>
                                        <option value="">Ciudad</option>
                                        <option value="Bahia Blanca">Bahia Blanca</option>
                                        <option value="Buenos Aires"> Buenos Aires</option>
                                        <option value="Comodoro Rivadavia"> Comodoro Rivadavia</option>
                                        <option value="Cordoba"> Cordoba</option>
                                        <option value="Corrientes"> Corrientes</option>
                                        <option value="Formosa"> Formosa</option>
                                        <option value="La Plata"> La Plata</option>
                                        <option value="Mar Del Plata"> Mar del Plata</option>
                                        <option value="Mendoza"> Mendoza</option>
                                        <option value="Neuquen"> Neuquen</option>
                                        <option value="Parana"> Parana</option>
                                        <option value="Posadas"> Posadas</option>
                                        <option value="Resistencia"> Resistencia</option>
                                        <option value="Rosario"> Rosario</option>
                                        <option value="Salta"> Salta</option>
                                        <option value="Tucuman"> San Miguel de Tucuman</option>
                                    </select>
                            </div>
                         </div>

                         <div class="col-md-4">
                              <div class="form-group">  
                                <select name="idCareer" class="form-select form-input" required>
                                   <option value="" selected>Carrera</option>
                                    <?php foreach($careerList as $career){?>
                                        <option value="<?php echo $career->getIdCareer()?>"><?php echo $career->getName()?></option>
                                    <?php
                                }?>
                                </select>
                              </div>
                         </div> 

                         <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="workload" class="form-control form-input" placeholder="Carga Horaria" required>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                              <div class="form-group">
                                    <textarea type="text" name = "requirements" value="" class="form-control form-textarea" placeholder="Requerimientos" required></textarea>
                              </div>
                         </div>

                         <div class="col-md-6">
                              <div class="form-group">
                                    <textarea type="text" name = "description" value="" class="form-control form-textarea" placeholder="Sobre la publicación" required></textarea>
                              </div>
                         </div>

                    </div>

                    <div class="row my-3">
                         <div class="col-md-6">
                              <input type="file" name="flyer" id="imgFlyer" class="visually-hidden">
                              <label class="btn button-blue" for="imgFlyer">Subi una imagen <i class="fas fa-upload ms-3"></i></label>
                         </div>
                         <div class="col-md-6">
                              <img alt="preview flyer" id="previewFlyer" class="visually-hidden preview-flyer">
                         </div>
                    </div>

                    <div class="row">
                         <div class="col-md-4">
                              <div class="form-group">
                                   <label for="">Fecha de Cierre</label>
                                   <input type="date" name="expireDate" value="" class="form-control form-input" required>
                              </div>
                         </div>
                        
                    </div>

                    <div class="row mt-3 justify-content-end">
                         <div class="col-md-3">
                              <button type="submit" class="btn button-blue w-100">Agregar</button>
                         </div>
                    </div> 

               </form>
          </div>
     </section>
</main>

<script>
     let imgFile = document.getElementById("imgFlyer");
     let preview = document.getElementById("previewFlyer");
     imgFile.onchange = evt => {
          const [file] = imgFile.files;
          if(file){
               preview.src = URL.createObjectURL(file);
               preview.classList.remove("visually-hidden");
          }else{
               preview.src = "";
               preview.classList.add("visually-hidden");
          }
     }
</script>

<?php
require_once ("footer.php");
?>
