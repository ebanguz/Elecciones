<?php 

class Elecciones {

    public $id_elecciones;
    public $nombre;
    public $fecha;
    public $estado;

    public function InizializeData(

        $id_elecciones,
        $nombre,
        $fecha,
        $estado
    ) {

        $this->id_elecciones = $id_elecciones;
        $this->nombre = $nombre;
        $this->fecha = $fecha;
        $this->estado = $estado;

    }
}
