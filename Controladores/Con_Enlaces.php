<?php

class Con_Enlaces
{
    public function Enlaces()
    {
        $pagina = " ";
        if (isset($_GET["pagina"])) {
            $enlaces = $_GET["pagina"];

            if ($enlaces == "inicio" ||
                $enlaces == "tablero" ||
                $enlaces == "revisiones" ||
                $enlaces == "sprintcreacion" ||
                $enlaces == "responsable" ||
                $enlaces == "slide" ||
                $enlaces == "diccionario" ||
                $enlaces == "salir") {

                $pagina = "vistas/" . $enlaces . ".php";
            }
        } else {
            $pagina = "vistas/inicio.php";
        }
        if ($pagina != " ") {
            include_once $pagina;
        }
    }
}
