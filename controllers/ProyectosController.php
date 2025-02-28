<?php 

namespace Controllers;

use Model\Proyectos;
use Model\Tareas;
use MVC\Router;

class ProyectosController {
    public static function crearTarea(Router $router) {
        $alertas = [];
        session_start();
        $proyecto = Proyectos::where("url", $_POST["url"]);
        $args["nombre"] = $_POST["nombre"];
        $args["id_proyecto"] = $proyecto->id;
        $tarea = new Tareas($args);
        if(empty($tarea)) {
            $tarea->guardar();
            header("Location: /proyecto?url=" . $_POST["url"]);
        } else {
            $alertas = $tarea->validarCampos();
        }
        $router->render("dashboard/crear-tareas", [
            "titulo" => "Dashboard",
            "proyecto" => $proyecto->proyecto,
            "alertas" => $alertas
        ]);
    }
}

?>