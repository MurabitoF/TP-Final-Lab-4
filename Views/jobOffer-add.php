<?php 
include('header.php');
include('nav.php');

?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar Publicacion</h2> 

               <form action="<?php echo FRONT_ROOT?>JobOffer/Add" method="post" class="bg-light-alpha p-5">
                    <div class="row">
                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                    <label for="">Titulo</label>
                                    <textarea type="text" name = "title" value="" class="form-control"></textarea>
                              </div>
                         </div>
                         
                         <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Carrera</label>
                                    <select name="category" class="form-control" required>
                                        <option value=""></option>
                                        <option value="Ingenieria">Ingenieria</option>
                                        <option value="Programacion">Programacion</option>
                                        <option value="Agriculcura">Agriculcura</option>
                                        <option value="Seguridad e Higiene"> Seguridad e Higiene</option>
                                    </select>
                            </div>
                        </div>
                    
                         <div class="col-lg-4">
                              <div class="form-group">  
                                <label for="">Empresa</label><!-- ver si anda esto -->
                                <select name="company" class="form-control" required>
                                    <?php foreach($companyList as $company){?>
                                        <option value="<?php $company?>"><?php $company->GetName?></option>
                                    <?php
                                }?>
                                </select>
                              </div>
                         </div>

                         <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Ciudad</label>
                                    <select name="city" class="form-control" required>
                                        <option value=""></option>
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

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Posicion de Trabajo</label>  <!--VER Y AGREGAR PUESTOS COHERENTES DESPUES --> 
                                    <select name="jobPosition" class="form-control" required>
                                        <option value=""></option>
                                        <option value="ceo">CEO</option>
                                        <option value="ingeniero">Ingeniero</option>
                                        <option value="programador">Programador</option>
                                    </select>
                            </div>
                        </div>

                        <div class="col-lg-4">
                              <div class="form-group">
                                    <label for="">Requerimientos</label> <!-- VER LUEGO SI CONVIENE YA DAR OPCIONES PREDETERMINADAS PARA ELEGIR -->
                                    <textarea type="text" name = "requeriments" value="" class="form-control"></textarea>
                              </div>
                         </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Carga Horaria</label>
                                <input type="number" name="workload" class="form-control" min="0" required>
                            </div>
                        </div>

                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Fecha de Ingreso</label>
                                   <input type="date" name="income" value="" class="form-control">
                              </div>
                         </div>
                        
                         <div class="col-lg-4">
                              <div class="form-group">
                                    <label for="">Descripcion</label>
                                    <textarea type="text" name = "jobOffer_description" value="" class="form-control"></textarea>
                              </div>
                         </div>
          
                    </div>
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
               </form>
          </div>
     </section>
</main>
