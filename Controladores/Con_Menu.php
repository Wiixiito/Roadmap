<?php
class Con_Menu
{


		public function CargarMenu(){

			$dao = new Dao();
			$dao->Campo("rol", "");
			$dao->Where("rol",$_SESSION["rol"],"");
			$dao->Tabla("usuario","");

			$respuesta =$dao->Consultar();
			//$data = array();
			//$total=0;
			foreach ($respuesta as $row => $item){

				$menu = '';

				if($item[0]==1){
						$menu = '<div class="menu">
                            <ul class="list">
                                <li class="header">MAIN NAVIGATION</li>
                                <li class="lista" id="listaSprint">
                                    <a href="index.php?pagina=sprintcreacion">
                                        <i class="material-icons">widgets</i>
                                        <span>Creacion de Sprint  </span>
                                    </a>
                                </li>
                                 <li class="lista" id="listaResponsable">
                                    <a href="index.php?pagina=responsable">
                                        <i class="material-icons">widgets</i>
                                        <span>Creacion de Responsable  </span>
                                    </a>
                                </li>
                                <li class="lista" id="listaTablero">
                                    <a href="index.php?pagina=tablero">
                                        <i class="material-icons">assignment</i>
                                        <span>Tablero Kanban</span>
                                    </a>
                                </li>
                                
                                <li class="lista" id="listaSlide">
                                    <a href="index.php?pagina=slide">
                                        <i class="material-icons">widgets</i>
                                        <span>Slide App </span>
                                    </a>
                                </li>
                                <li class="lista" id="listaDiccionario">
                                    <a href="index.php?pagina=diccionario">
                                        <i class="material-icons">widgets</i>
                                        <span>Diccionario App </span>
                                    </a>
                                </li>
                                <li class="lista" id="listaRevisiones">
                                    <a href="index.php?pagina=revisiones">
                                        <i class="material-icons">widgets</i>
                                        <span>Tablero de Revisiones QA </span>
                                    </a>
                                </li>
                                
                            </ul>
                        </div>';
				}else if($item[0]==2){
					$menu = '<div class="menu">
                            <ul class="list">
                                <li class="header">MAIN NAVIGATION</li>
                                <li class="active">
                                    <a href="index.php?pagina=tablero">
                                        <i class="material-icons">assignment</i>
                                        <span>Tablero Kanban</span>
                                    </a>
                                </li>
                                <li class="lista" id="listaRevisiones">
                                    <a href="index.php?pagina=revisiones">
                                        <i class="material-icons">widgets</i>
                                        <span>Tablero de Revisiones QA </span>
                                    </a>
                                </li>
                            </ul>
                        </div>';

				}

					
			}
			
        echo $menu;

		}



}