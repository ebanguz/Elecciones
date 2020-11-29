<?php 

class Candidatos {

    public $id_candidato;
    public $nombre;
    public $apellido;
    public $id_partido;
    public $id_puesto;
    public $foto_perfil;
    public $estado;

    public function InizializeData(

        $id_candidato,
        $nombre,
        $apellido,
        $id_partido,
        $id_puesto,
        $foto_perfil,
        $estado
    ) {

        $this->id_candidato = $id_candidato; 
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->id_partido = $id_partido;
        $this->id_puesto = $id_puesto;
        $this->foto_perfil = $foto_perfil;
        $this->estado = $estado;

    }
}
