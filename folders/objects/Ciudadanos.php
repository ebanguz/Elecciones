<?php 

class Ciudadanos {

    public $cedula;
    public $nombre;
    public $apellido;
    public $email;
    public $estado;

    public function InizializeData(

        $cedula,
        $nombre,
        $apellido,
        $email,
        $estado
    ) {

        $this->cedula = $cedula; 
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->estado = $estado;

    }
}
