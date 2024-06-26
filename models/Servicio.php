<?php

namespace Model;

class Servicio extends ActiveRecord {
    //Base de datos
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre', 'precio', 'estado'];

    public $id;
    public $nombre;
    public $precio;
    public $estado;

    public function __construct($args = []) {

        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->estado = $args['estado'] ?? 0;
    }

    public function validar() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre del Servicio es Obligatirio';
        }
        if(!$this->precio) {
            self::$alertas['error'][] = 'El Precio del Servicio es Obligatirio';
        }
        if(!is_numeric($this->precio)) {
            self::$alertas['error'][] = 'El Precio no es valido';
        }

        return self::$alertas;
    }
}
