<?php

namespace Model;

class Tareas extends ActiveRecord {
    protected static $tabla = "tareas";
    protected static $columnasDB = ["id", "nombre", "estado", "id_proyecto"];

    public $id;
    public $nombre;
    public $estado;
    public $id_proyecto;

    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->estado = $args["estado"] ?? 0;
        $this->id_proyecto = $args["id_proyecto"] ?? "";
    }

    public function validarCampos() {
        if(!$this->nombre) self::$alertas["error"][] = "Nombre vacio";
        return self::$alertas;
    }

    public static function obtenerTareas($id_proyecto) {
        $query = "SELECT * FROM tareas WHERE tareas.id_proyecto = '$id_proyecto'";
        return self::consultarSQL($query);
    }
    
    public static function obtenerPendientes($id_proyecto) {
        $query = "SELECT * FROM tareas WHERE tareas.id_proyecto = '$id_proyecto' AND tareas.estado = 0";
        return self::consultarSQL($query);
    }

    public static function obtenerCompletadas($id_proyecto) {
        $query = "SELECT * FROM tareas WHERE tareas.id_proyecto = '$id_proyecto' AND tareas.estado = 1";
        return self::consultarSQL($query);
    }
}

?>