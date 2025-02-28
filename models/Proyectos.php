<?php 

namespace Model;

class Proyectos extends ActiveRecord {
    protected static $tabla = "proyecto";
    protected static $columnasDB = ["id", "proyecto", "url", "id_usuario"];

    public $id;
    public $proyecto;
    public $url;
    public $id_usuario;

    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->proyecto = $args["proyecto"] ?? "";
        $this->url = $args["url"] ?? "";
        $this->id_usuario = $args["id_usuario"] ?? null;
    }

    public static function obtenerProyectos($id_usuario) {
        $query = "SELECT * FROM proyecto WHERE proyecto.id_usuario = '$id_usuario'";
        return self::consultarSQL($query);
    }

    public function validarProyecto() {
        if(!$this->proyecto) self::$alertas["error"][]  = "Nombre vacio";
        return self::$alertas;
    }

    public function setIdTemporal() {
        $this->id_temporal = rand(1000000, 9999999);
    }
}

?>