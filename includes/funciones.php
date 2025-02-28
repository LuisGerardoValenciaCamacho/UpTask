<?php

define("FUNCIONES_URL", "funciones.php");
define("CARPETA_IMAGENES", $_SERVER["DOCUMENT_ROOT"] . "/imagenes/");

function debuguear($informacion) {
    echo "<pre>";
    var_dump($informacion);
    echo "</pre>";
    exit;
}

function sanitizar($html) : string {
    $sanitizar = htmlspecialchars($html);
    return $sanitizar;
}

function validarTipoContenido($tipo) {
    $tipos = ["usuario", "propiedad"];
    return in_array($tipo, $tipos);
}

function validar(string $url) {
    $id = $_GET["id"] ?? $_POST["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id) {
        header("location: $url");
    }
    return $id;
}

function isAuth() {
    if(!isset($_SESSION["login"])) {
        header("Location: /");
    }
}

function isAdmin() {
    if(!$_SESSION["admin"]) {
        header("Location: /");
    }
}

function imprimir($informacion) {
    echo "<pre>";
    var_dump($informacion);
    echo "</pre>";
}