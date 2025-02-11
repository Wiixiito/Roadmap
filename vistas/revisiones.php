 
 <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                EXPORTABLE TABLE
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="tablaRevision" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Modulo Principal</th>
                                            <th>funcionabilidad</th>
                                            <th>Observaciones</th>
                                            <th>Imagenes</th>
                                            <th>Verificado</th>
                                            <th>Observaciones</th>
                                            <th>verificado base</th>

                                        </tr>
                                    </thead>
                                   
                                    <tbody style="font-size: 15px;">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



<!-- Modal para observaciones -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" >Observaciones del modulo</h4>
                        </div>
                        <div class="modal-body">
                            <p id="obser"></p>
                              <p id="idobser" style="display:none;" ></p>
                                 <div class="form-line" >
                                    <input type="text" id="ingredesc" class="form-control" placeholder="Ingrese Observacion" >
                                </div>
                        </div>
                    
                        <div class="modal-footer">
                            <button type="button" id="guardardescripcion" class="btn btn-link waves-effect">Guardar</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Salir</button>
                        </div>
                    </div>
                </div>
            </div>


<!-- Modal para fotos -->
<div class="modal fade" id="myModalFotos" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" >Fotos</h4>
                            <p style="display:none;" id="idfoto"></p>
                        </div>
                        <div class="col-md-12" id="FileInput">
                        <div >
                           <input id="archivos" name="imagenes[]" type="file" multiple class="file-loading">
                        </div>
                    </div>
                    
                        <div class="modal-footer">
                            <button type="button" id="GuardarProducto"  data-dismiss="modal" class="btn btn-link waves-effect">Guardar</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Salir</button>
                        </div>
                    </div>
                </div>
            </div>





<?php
  $directory = "fotos/";
  $images = glob($directory . "*.*");
?>




<script src="plugins/jquery/jquery.min.js"></script>


<script src="Lib/fileinput.min.js" type="text/javascript"></script>
<script src="Lib/fileinput_locale_es.js" type="text/javascript"></script>

<!-- Jquery DataTable Plugin Js -->
    <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
<script src="js/Js_Revisiones.js?v=2.17"></script>