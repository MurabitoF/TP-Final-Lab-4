<?php 
require_once('verify-login.php');
include('header.php');
include('nav.php');

?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4 text-center">Agregar Publicación</h2> 
               <form action="<?php echo FRONT_ROOT ?>JobOffer/Add" method="post" class="bg-light-alpha p-5">
                    <div class="row">
                         <div class="col-md-6">
                              <div class="form-group">
                                   <input type="text" name="title" class="form-control form-input shadow-none" placeholder="Título de la publicación" required>      
                              </div>
                         </div>

                         <div class="col-md-6">
                              <div class="form-group">  
                                <select name="idJobPosition" class="form-control form-input" required>
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
                                    <select name="city" class="form-control form-input" required>
                                        <option value="">Ciudad</option>
                                        <option value="bahia">Bahia Blanca</option>
                                        <option value="buenosAires"> Buenos Aires</option>
                                        <option value="comodoro"> Comodoro Rivadavia</option>
                                        <option value="cordoba"> Cordoba</option>
                                        <option value="corrientes"> Corrientes</option>
                                        <option value="formosa"> Formosa</option>
                                        <option value="laPlata"> La Plata</option>
                                        <option value="marDelPlata"> Mar del Plata</option>
                                        <option value="mendoza"> Mendoza</option>
                                        <option value="neuquen"> Neuquen</option>
                                        <option value="parana"> Parana</option>
                                        <option value="posadas"> Posadas</option>
                                        <option value="resistencia"> Resistencia</option>
                                        <option value="rosario"> Rosario</option>
                                        <option value="salta"> Salta</option>
                                        <option value="tucuman"> San Miguel de Tucuman</option>
                                    </select>
                            </div>
                         </div>

                         <div class="col-md-4">
                              <div class="form-group">  
                                <select name="idCareer" class="form-control form-input" required>
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
                                    <textarea type="text" name = "requeriments" value="" class="form-control form-textarea" placeholder="Requerimientos" required></textarea>
                              </div>
                         </div>

                         <div class="col-md-6">
                              <div class="form-group">
                                    <textarea type="text" name = "description" value="" class="form-control form-textarea" placeholder="Sobre la publicación" required></textarea>
                              </div>
                         </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4">
                              <div class="form-group">
                                   <label for="">Fecha de Ingreso</label>
                                   <input type="date" name="postDate" value="" class="form-control" required>
                              </div>
                         </div>

                         <div class="col-md-4">
                              <div class="form-group">
                                   <label for="">Fecha de Expiración</label>
                                   <input type="date" name="expireDate" value="" class="form-control" required>
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
