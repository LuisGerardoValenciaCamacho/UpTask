<?php

namespace Controllers;

use Model\Proyectos;
use Model\Tareas;

class ApiController {
    public static function obtenerTodas() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $proyecto = Proyectos::where("url", $_POST["url"]);
            $tarea = Tareas::obtenerTareas($proyecto->id);
            echo json_encode(["tareas" => $tarea]);
        }
    } 

    public static function crearTarea() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            session_start();
            $proyecto = Proyectos::where("url", $_POST["url"]);
            if(is_null($proyecto) || $proyecto->id_usuario != $_SESSION["id"]) {
                $array = [
                    "tipo" => "error",
                    "mensaje" => "Hubo un Error al Agregar la Tarea"
                ];
                echo json_encode($array);
                return;
            }
            if(isset($_POST["id"])) {
                $tarea = Tareas::find($_POST["id"]);
                $tarea->nombre = $_POST["nombre"];
                $mensaje = "Tarea Actualizada Correctamente";
            } else {
                $tarea = new Tareas($_POST);
                $tarea->id_proyecto = $proyecto->id;
                $mensaje = "Tarea Agregada Correctamente";
            }
            $resultado = $tarea->guardar();
            $array = [
                "tipo" => "correcto",
                "mensaje" => $mensaje,
                "id" => $resultado["id"],
                "id_proyecto" => $proyecto->id
            ];
            echo json_encode($array);
        }
    }

    public static function cambiarEstados() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $tarea = Tareas::find($_POST["id"]);
            $tarea->estado = $_POST["estado"] == 0 ? 1 : 0;
            $tarea->guardar();
            $array = [
                "tipo" => "success",
                "mensaje" => "Cambio Realizado"
            ];
            echo json_encode($array);
        }
    }

    public static function eliminarTarea() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $tarea = Tareas::find($_POST["id"]);
            $tarea->eliminar();
            $array = [
                "tipo" => "success",
                "mensaje" => "Tarea eliminada",
                "id" => $_POST["id"]
            ];
            echo json_encode($array);
        }
    }
}

?>