<?php 

namespace Controllers;

use Model\Login;
use Model\Proyectos;
use MVC\Router;

class DashboardController {
    public static function inicio(Router $router) {
        session_start();
        $id = $_SESSION["id"] ?? null;
        $proyectos = Proyectos::obtenerProyectos($id);
        if(!$_SESSION["login"]) {
            header("Location: /");
        }
        $router->render("dashboard/inicio", [
            "titulo" => "Dashboard",
            "proyectos" => $proyectos,
        ]);
    }

    public static function crearProyecto(Router $router) {
        session_start();
        $alertas = [];
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $proyectos = new Proyectos($_POST);
            $alertas = $proyectos->validarProyecto();
            if(empty($alertas)) {
                $proyectos->id_usuario = $_SESSION["id"];
                $proyectos->url = md5(uniqid());
                imprimir($proyectos);
                $proyectos->guardar();
                header("Location: /proyecto?url=" . $proyectos->url);
            }
        }
        $router->render("dashboard/crear-proyecto", [
            "titulo" => "Crear Proyecto",
            "alertas" => $alertas
        ]);
    }

    public static function updateProyecto(Router $router) {
        session_start();
        $alertas = [];
        $proyectos = Proyectos::where("url", $_GET["url"]);
        if(empty($proyectos)) {
            $alertas["error"][] = "URL del Proyecto No Existe";
        } else {
            $proyecto = $proyectos->proyecto;
        }
        $router->render("dashboard/crear-tareas", [
            "titulo" => "Dashboard",
            "proyecto" => $proyecto,
            "alertas" => $alertas
        ]);
    }

    public static function perfil(Router $router) {
        session_start();
        $alertas = [];
        $usuario = Login::find($_SESSION["id"]);
        $usuario-> password = "";
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if($_POST["password"] !== $_POST["passwordReply"])  {
                $alertas["error"][] = "Contraseñas no coinciden";
            } else {
                $usuario->sincronizar($_POST);
                $alertas = $usuario->errores();
                if(!$alertas) {
                    $usuario->hashPassord();
                    $usuario->guardar();
                    $_SESSION["nombre"] = $_POST["nombre"];
                    header("Location: /uptask");
                }
            }
        }
        $router->render("dashboard/perfil", [
            "titulo" => "Perfil",
            "usuario" => $usuario,
            "alertas" => $alertas
        ]);
    }
}

?>