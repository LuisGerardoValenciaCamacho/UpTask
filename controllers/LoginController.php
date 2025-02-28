<?php

namespace Controllers;

use Classes\Email;
Use MVC\Router;
Use Model\Login;

class LoginController {
    public static function login(Router $router) {
        $alertas = [];
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if(!$_POST["email"]) $alertas["error"][] = "E-mail Vacio";
            if(!$_POST["password"]) $alertas["error"][] = "Password Vacio";
            if(!$alertas) {
                $usuario = Login::where("email", $_POST["email"]);
                if(!$usuario) {
                    $alertas["error"][] = "El Usuario No Existe";
                } else {
                    if(!password_verify($_POST["password"], $usuario->password)) {
                        $alertas["error"][] = "Password Incorrecto";
                    } else {
                        if($usuario->confirmado != "1") $alertas["error"][] = "Primero Tienes que Confirmar tu Cuenta";
                    }
                }
                if(!$alertas) {
                    session_start();
                    $_SESSION["id"] = $usuario->id;
                    $_SESSION["nombre"] = $usuario->nombre;
                    $_SESSION["email"] = $usuario->email;
                    $_SESSION["login"] = true;
                    header("Location: /uptask");
                }
            }
        }
        $router->render("auth/index", [
            "titulo" => "Iniciar Sesión",
            "alertas" => $alertas
        ]);
    }

    public static function registro(Router $router) {
        $alertas = [];
        $usuario = new Login();
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario = new Login($_POST);
            $alertas = $usuario->errores();
            if(!$alertas) {
                $usuario->setToken();
                $usuario->hashPassord();
                $usuario->guardar();
                $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                $email->enviarConfirmacion();
                header("Location: /confirmar");
            }
        }
        $router->render("auth/registro", [
            "titulo" => "Registro",
            "usuario" => $usuario,
            "alertas" => $alertas
        ]);
    }

    public static function password(Router $router) {
        $alertas = [];
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if($_POST["email"] != "") {
                $usuario = Login::where("email", $_POST["email"]);
                if($usuario) {
                    $usuario->setToken();
                    $usuario->guardar();
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                    $email->enviarRecuperacion();
                    header("Location: /update-password");
                } else {
                    $alertas["error"][] = "El usuario no existe";
                }
            } else {
                $alertas["error"][] = "E-mail Vacio";
            }
        }
        $router->render("auth/password", [
            "titulo" => "Actualizar Password",
            "alertas" => $alertas
        ]);
    }
    
    public static function mensaje(Router $router) {
        $_SERVER["PATH_INFO"] == "/confirmar" ? $alertas["correcto"][] = "Se le envio un correo para confirmar la cuenta" : $alertas["correcto"][] = "Se le envio un correo con su token para actualizar su password";
        $_SERVER["PATH_INFO"] == "/confirmar" ? $mensaje = "Confirmar Cuenta" : $mensaje = "Actualizar password";
        $router->render("auth/mensajes", [
            "titulo" => "Mensaje",
            "mensaje" => $mensaje,
            "alertas" => $alertas
        ]);
    }

    public static function confirmarCuenta(Router $router) {
        $token = sanitizar($_GET["token"]);
        $usuario = Login::where("token", $token);
        if($usuario) {
            $usuario->token = 0;
            $usuario->confirmado = 1;
            $usuario->guardar();
            $alertas["correcto"][] = "Cuenta Confirmada";
        } else {
            $alertas["error"][] = "Token No Existe";
        }
        $router->render("auth/mensajes", [
            "titulo" => "Confirmar Cuenta",
            "mensaje" => "Cuenta Confirmada",
            "alertas" => $alertas
        ]);
    }

    public static function recuperarPassword(Router $router) {
        $alertas = [];
        $token = $_GET["token"] ?? $_POST["token"];
        $usuario = Login::where("token", $token);
        if($usuario == null) {
            $alertas["error"][] = "Token No Existe";
        }
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario->password = $_POST["password"];
            $usuario->hashPassord();
            $usuario->token = 0;
            $usuario->guardar();
            header("Location: /confirmar-password");
        }
        $router->render("auth/reestablecer", [
            "titulo" => "Actualizar Password",
            "mensaje" => "Cuenta Confirmada",
            "alertas" => $alertas,
            "token" => $token
        ]);
    }

    public static function confirmarPassword(Router $router) {  
        $alertas["correcto"][] = "Cambio de Password Confirmado";
        $router->render("auth/mensajes", [
            "titulo" => "Confirmar Password",
            "mensaje" => "Password Actualizado",
            "alertas" => $alertas
        ]);
    }

    public static function logout() {
        session_start();
        $_SESSION = [];
        header("Location: /");
    }
}

?>