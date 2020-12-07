<?php

require_once '../../../databaseHandler/databaseConnection.php';
require_once '../../../iDataBase/IDatabase.php';

class CandidatosHandler implements IDataBaseHandler
{

    private $connection;

    function __construct($directory)
    {
        $this->connection = new databaseConnection($directory);
    }

    function getActiveAll()
    {

        $tableList = array();

        $stm = $this->connection->db->prepare('Select * FROM Candidatos where estado = true');
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return $tableList;
        } else {
            while ($row = $result->fetch_object()) {
                $user = new Candidatos();

                $user->id_candidato = $row->id_candidato;
                $user->nombre = $row->nombre;
                $user->apellido = $row->apellido;
                $user->id_partido = $row->id_partido;
                $user->id_puesto = $row->id_puesto;
                $user->foto_perfil = $row->foto_perfil;
                $user->estado = $row->estado;

                array_push($tableList, $user);
            }

            $stm->close();
            return $tableList;
        }
    }

    function getActive()
    {

        $tableList = array();

        $stm = $this->connection->db->prepare('Select * FROM Candidatos');
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return $tableList;
        } else {
            while ($row = $result->fetch_object()) {
                $user = new Candidatos();

                $user->id_candidato = $row->id_candidato;
                $user->nombre = $row->nombre;
                $user->apellido = $row->apellido;
                $user->id_partido = $row->id_partido;
                $user->id_puesto = $row->id_puesto;
                $user->foto_perfil = $row->foto_perfil;
                $user->estado = $row->estado;

                array_push($tableList, $user);
            }

            $stm->close();
            return $tableList;
        }
    }

    function getInactive()
    {
    }

    function getCandidateByPuesto($idPuesto)
    {

        $tableList = array();

        $stm = $this->connection->db->prepare('Select * FROM Candidatos where id_puesto = ?');
        $stm->bind_param('i', $idPuesto);
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return $tableList;
        } else {
            while ($row = $result->fetch_object()) {
                $user = new Candidatos();

                $user->id_candidato = $row->id_candidato;
                $user->nombre = $row->nombre;
                $user->apellido = $row->apellido;
                $user->id_partido = $row->id_partido;
                $user->id_puesto = $row->id_puesto;
                $user->foto_perfil = $row->foto_perfil;
                $user->estado = $row->estado;

                array_push($tableList, $user);
            }

            $stm->close();
            return $tableList;
        }
    }

    function getById($id)
    {
        $stm = $this->connection->db->prepare('Select * FROM Candidatos where id_candidato = ?');
        $stm->bind_param('i', $id);
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return null;
        } else {

            $row  = $result->fetch_object();
            $user = new Candidatos();

            $user->id_candidato = $row->id_candidato;
            $user->nombre       = $row->nombre;
            $user->apellido     = $row->apellido;
            $user->id_partido   = $row->id_partido;
            $user->id_puesto    = $row->id_puesto;
            $user->foto_perfil  = $row->foto_perfil;
            $user->estado       = $row->estado;

            $stm->close();
            return $user;
        }
    }

    function Add($entity)
    {
        if (isset($_FILES['fotoperfil'])) {
            $foto = $_FILES['fotoperfil'];

            if ($foto['error'] == 4) {
                $entity->foto = "";
            } else {

                $typeReplace = str_replace("image/", "", $_FILES['fotoperfil']['type']);
                $type        = $foto['type'];
                $size        = $foto['size'];
                $name        = $entity->nombre . $entity->apellido . '.' . $typeReplace;
                $timeFile    = $foto['tmp_name'];

                $sucess = $this->uploadImage('../../../assets/images/candidatos/', $name, $timeFile, $type, $size);

                if ($sucess) {

                    $entity->foto_perfil = $name;
                }
            }
        }

        $stm = $this->connection->db->prepare('insert into Candidatos (nombre, apellido, id_partido, id_puesto, foto_perfil, estado) Values(?, ?, ?, ?, ?, ?)');
        $stm->bind_param('ssiisi', $entity->nombre, $entity->apellido, $entity->id_partido, $entity->id_puesto, $entity->foto_perfil, $entity->estado);
        $stm->execute();
        $stm->close();
    }

    function Habilitar($id)
    {
        $stm = $this->connection->db->prepare("update Candidatos set estado= 1 where id_candidato=?");
        $stm->bind_param("i", $id);
        $stm->execute();
        $stm->close();
    }

    function Deshabilitar($id)
    {
        $stm = $this->connection->db->prepare("update Candidatos set estado= 0 where id_candidato=?");
        $stm->bind_param("i", $id);
        $stm->execute();
        $stm->close();
    }

    function Edit($entity)
    {
        if (isset($entity->foto_perfil)) {
            $foto = [];
            $foto = $entity->foto_perfil;

            if ($foto['error'] == 4) {
                $entity->foto = "";
            } else {

                $typeReplace = str_replace("image/", "", $_FILES['fotoperfil']['type']);
                $type        = $foto['type'];
                $size        = $foto['size'];
                $name        = $entity->nombre . $entity->apellido . '.' . $typeReplace;
                $timeFile    = $foto['tmp_name'];

                $sucess = $this->uploadImage('../../../assets/images/candidatos/', $name, $timeFile, $type, $size);

                if ($sucess) {

                    $entity->foto_perfil = $name;
                }
            }
        }

        $stm = $this->connection->db->prepare('update Candidatos set nombre = ?, apellido = ?, id_partido = ?, id_puesto = ?, foto_perfil = ?, estado = ?  where id_candidato = ?');
        var_dump($entity);
        $stm->bind_param('ssiisii', $entity->nombre, $entity->apellido, $entity->id_partido, $entity->id_puesto, $entity->foto_perfil, $entity->estado, $entity->id_candidato);
        $stm->execute();
        $stm->close();
    }

    private function uploadFile($name, $timeFile)
    {

        if (file_exists($name)) {

            unlink($name);
        }

        move_uploaded_file($timeFile, $name);
    }

    public function uploadImage($directory, $name, $timeFile, $type, $size)
    {

        $isSucess = false;
        if (($type == "image/gif")
            || ($type == "image/jpeg")
            || ($type == "image/png")
            || ($type == "image/jpg")
            || ($type == "image/JPG")
            || ($type == "image/jfif")
            || ($type == "image/pjpeg") && ($size < 1000000)
        ) {


            if (!file_exists($directory)) {

                mkdir($directory, 0777, true);

                if (file_exists($directory)) {

                    $this->uploadFile($directory . $name, $timeFile);
                    $isSucess = true;
                }
            } else {

                $this->uploadFile($directory . $name, $timeFile);
                $isSucess = true;
            }
        } else {

            $isSucess = false;
        }

        return $isSucess;
    }
}
