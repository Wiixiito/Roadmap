

            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">help</i>
                        </div>
                        <div class="content">
                            <div class="text">Pendientes</div>
                            <div class="number count-to" data-from="0" data-to="<?php $Dao = new Con_Contadores(); $Dao->TotalPendientes();?>" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">En proceso</div>
                            <div class="number count-to" data-from="0" data-to="<?php $Dao = new Con_Contadores(); $Dao->TotalProgreso();?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">Finalizado</div>
                            <div class="number count-to" data-from="0" data-to="<?php $Dao = new Con_Contadores(); $Dao->TotalCompletadas();?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- #END# Widgets -->
            <!-- CPU Usage -->
            
            <!-- #END# CPU Usage -->
           

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-12">
                    <div class="card">
                       
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos" id="porcentajes">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th style="width: 35%;" >Tarea</th>
                                            <th>Status</th>
                                            <th>Responsable</th>
                                            <th style="width: 20%;">Progreso</th>
                                        </tr>
                                    </thead>
                                   
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
                
                <!-- #END# Browser Usage -->
            </div>
 <script src="plugins/jquery/jquery.min.js"></script>
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

<script src="js/Js_Porcentaje.js?v=1.3"></script>    