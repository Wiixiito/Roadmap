 <div class="panel-group" id="accordion_1" role="tablist" aria-multiselectable="true">
                                      <div class="panel panel-col-pink">
    <div class="panel-heading" role="tab" id="headingTwo_1">
        <h4 class="panel-title">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseTwo_1" aria-expanded="true" aria-controls="collapseTwo_1">
                Registro de Fotos para Slide y descripciones
            </a>
        </h4>
    </div>
    <div id="collapseTwo_1" class="panel-collapse" role="tabpanel" aria-labelledby="headingTwo_1">
        <div class="panel-body">
            <div class="card">
                <div class="body">
                    <form id="sign_in" method="POST">

                        <div class="input-group">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" >Fotos para Slide / maximo 1 foto</h4>
                                        <p style="display:none;" id="idfoto"></p>
                                    </div>
                                    <div class="col-md-12" id="FileInput">
                                    <div >
                                       <input id="archivos" name="imagenes[]" type="file" multiple class="file-loading">
                                    </div>
                                </div>
                                
                                    <div class="modal-footer">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" id="descripcion" name="username" placeholder="Desccripcion de la foto " required autofocus>
                            </div>
                        </div>

                         <div class="row">
                            <div class="col-xs-12 align-right">
                                <button class="btn btn-block btn-lg bg-pink waves-effect" id="GuardarProducto" type="button">Guardar </button>
                            </div>
                        </div>
                                                                 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

                                      
                                    </div>



        
                
              
            </div>
            

            <!-- #END# Basic Example -->
            <!-- Colored Card - With Loading -->
           
           
       


<?php
  $directory = "fotos/";
  $images = glob($directory . "*.*");
?>




<script src="plugins/jquery/jquery.min.js"></script>


<script src="Lib/fileinput.min.js" type="text/javascript"></script>
<script src="Lib/fileinput_locale_es.js" type="text/javascript"></script>


<script src="js/Js_Slide.js?v=1.9"></script>



                                