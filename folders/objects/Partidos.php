<?php 

class Partidos {

    public $id_partido;
    public $nombre;
    public $descripcion;
    public $logo;
    public $estado;
    
    public function InizializeData(

        $id_partido,
        $nombre,
        $descripcion,
        $logo,
        $estado
        
    ) {

        $this->id_patido = $id_partido;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->logo = $logo;
        $this->estado = $estado;

    }
}
