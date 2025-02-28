<?php

require __DIR__ . "/../includes/app.php";

use Controllers\ApiController;
use Controllers\DashboardController;
use Controllers\LoginController;
use Controllers\admin;
use MVC\Router;

$router = new Router();

$router->get("/", [LoginController::class, "login"]);
$router->get("/logout", [LoginController::class, "logout"]);
$router->get("/registro", [LoginController::class, "registro"]);
$router->get("/password", [LoginController::class, "password"]);
$router->get("/confirmar", [LoginController::class, "mensaje"]);
$router->get("/update-password", [LoginController::class, "mensaje"]);
$router->get("/confirmar-cuenta", [LoginController::class, "confirmarCuenta"]);
$router->get("/recuperar-password", [LoginController::class, "recuperarPassword"]);
$router->get("/confirmar-password", [LoginController::class, "confirmarPassword"]);
$router->get("/uptask", [DashboardController::class, "inicio"]);
$router->get("/crear-proyecto", [DashboardController::class, "crearProyecto"]);
$router->get("/proyecto", [DashboardController::class, "updateProyecto"]);
$router->get("/perfil", [DashboardController::class, "perfil"]);
$router->get("/admin", [Admin::class], "admin");

$router->post("/", [LoginController::class, "login"]);
$router->post("/registro", [LoginController::class, "registro"]);
$router->post("/password", [LoginController::class, "password"]);
$router->post("/recuperar-password", [LoginController::class, "recuperarPassword"]);
$router->post("/crear-proyecto", [DashboardController::class, "crearProyecto"]);
$router->post("/api/tarea", [ApiController::class, "crearTarea"]);
$router->post("/api/todas", [ApiController::class, "obtenerTodas"]);
$router->post("/api/estados", [ApiController::class, "cambiarEstados"]);
$router->post("/api/eliminar", [ApiController::class, "eliminarTarea"]);
$router->post("/perfil", [DashboardController::class, "perfil"]);

$router->comprobarRutas();

?>