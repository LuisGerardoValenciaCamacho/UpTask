<?php

namespace Model;

use Model\ActiveRecord;

class Login extends ActiveRecord {
    protected static $tabla = "usuarios";
    protected static $columnasDB = ["id", "nombre", "email", "password", "token", "confirmado"];

    public $id;
    public $nombre;
    public $email;
    public $password;
    public $passwordReply;
    public $token;
    public $confirmado;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->email = $args["email"] ?? "";
        $this->password = $args["password"] ?? "";
        $this->passwordReply = $args["passwordReply"] ?? "";
        $this->token = $args["token"] ?? "";
        $this->confirmado = $args["confirmado"] ?? 0;
    }

    public function errores() {
        if(!$this->nombre) self::$alertas["error"][] = "Nombre Vacio";
        if(!$this->email) self::$alertas["error"][] = "E-mail Vacio";
        if(!$this->password) self::$alertas["error"][] = "Password Vacio";
        if(!$this->passwordReply) self::$alertas["error"][] = "Confirmar Password Vacio";
        if($this->password != $this->passwordReply) self::$alertas["error"][] = "Password no Coinciden";
        return self::$alertas;
    }

    public function hashPassord() {
        $this->password = password_hash($this->password, true);
    }

    public function setToken() {
        $this->token = rand(1000000000, 9999999999);
    }
}

?>