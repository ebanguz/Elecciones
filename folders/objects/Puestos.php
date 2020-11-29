<?php 

class Puestos {

    public $id_puesto;
    public $nombre;
    public $descripcion;
    public $estado;
    
    public function InizializeData(

        $id_puesto,
        $nombre,
        $descripcion,
        $estado
        
    ) {

        $this->id_puesto = $id_puesto;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->estado = $estado;

    }
}
