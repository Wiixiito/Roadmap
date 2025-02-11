 <!-- Bootstrap Select Css -->

    <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
 <div class="panel-group" id="accordion_1" role="tablist" aria-multiselectable="true">
                                       
                                        <div class="panel panel-col-pink">
                                            <div class="panel-heading" role="tab" id="headingTwo_1">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseTwo_1" aria-expanded="false"
                                                       aria-controls="collapseTwo_1">
                                                        Registro de Tareas
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo_1">
                                                <div class="panel-body">
                                                    <div class="card">
                                                        <div class="body">
                                                            <form id="sign_in" method="POST">
                                                               
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="material-icons">person</i>
                                                                    </span>
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="nombre" name="username" placeholder="Nombre de la tarea" required autofocus>
                                                                    </div>
                                                                </div>
                                                                 
              
                            
                                                                  
                                                                        <div class="input-group">

                                                                              <span class="input-group-addon">
                                                                                 <i class="material-icons">person</i>
                                                                             </span>
                                                                                <div class="form-line">
                                                                                    <textarea rows="1" id="descripcion" class="form-control resize" placeholder="Descripcion de la tarea..."></textarea>
                                                                                </div>
                                                                            
                                                                        
                                                                    </div>

                                                                  <div >
                                                                    <label class="card-inside-title">Responsable:</label>
                                                                        <select id="responsable" style="width: 10px; font-size: 2px;" >
                                                                        <option value="0">Seleccionar..</option>
                                                                        <?php
                                                                          $sprint = new Con_Contadores();
                                                                          $sprint->responsablecombo();
                                                                        ?>
                                                                        </select>
                                                                </div>



                                                                <div style="margin-top: 20px;">
                                                                    <label class="card-inside-title" >Sprint:</label>
                                                                        <select id="sprintregistro" style="width: 10px; font-size: 2px; " >
                                                                        <option value="0">Seleccionar..</option>
                                                                        <?php
                                                                          $sprint = new Con_Contadores();
                                                                          $sprint->sprintcombo();
                                                                        ?>
                                                                        </select>
                                                                </div>

                                                                <div style="margin-top: 20px;">
                                                                        <h2 class="card-inside-title" style="display: inline-block;">Fecha Inicio</h2>
                                                                        <input type="date" id="fecha_inicio" name="trip-start"  style="display: inline-block;"/>

                                                                        <h2 class="card-inside-title" style="display: inline-block;">Fecha Fin</h2>
                                                                        <input type="date" id="fecha_fin" name="trip-end"  style="display: inline-block;"/>
                                                                    </div>


                                                                 
                                                               

                                                                <div class="row">
                                                                    <div class="col-xs-12 align-right">
                                                                        <button class="btn btn-block btn-lg bg-pink waves-effect" id="guardar" type="button">INGRESAR</button>
                                                                    </div>
                                                                </div>

                                                                  <div class="col-sm-6">
                                   
                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      
                                    </div>


          
                <div class="col-lg- col-md-4 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header bg-pink">
                           

                          <label>Sprint:</label>
                            <select id="sprint" style="width: 10px; font-size: 2px;" >
                            <option value="0">Seleccionar..</option>
                            <?php
                              $sprint = new Con_Contadores();
                              $sprint->sprintcombo();
                            ?>
                            </select>

                               <h2 style="margin-top: 20px; text-align: center;">
                                   TO-DO
                               </h2>              
                        </div>

                                    

                                
                        <div class="body" id="pendientes">
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header bg-blue-grey">
                            <h2 style="margin-top: 50px; text-align: center;">
                                IN-PROGRESS
                            </h2>
                            
                        </div>
                        <div class="body" id="procesos">
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header bg-orange">
                            <h2 style="margin-top: 50px; text-align: center;">
                                DONE
                            </h2>
                           
                        </div>
                       <div class="body" id="completados">
                            
                        </div>
                    </div>
                </div>
            </div>
            

            <!-- #END# Basic Example -->
            <!-- Colored Card - With Loading -->
           
           
       





<script src="plugins/jquery/jquery.min.js"></script>
 

    

<script src="js/Js_Tareatablero.js?v=3.11"></script>                                    