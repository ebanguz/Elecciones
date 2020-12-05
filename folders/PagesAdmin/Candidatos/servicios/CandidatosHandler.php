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

    function getActive()
    {

        $tableList = array();

        $stm = $this->connection->db->prepare('Select * FROM Candidatos WHERE estado = true');
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

    function getById($id)
    {
    }

    function Add($entity)
    {
    }

    function Habilitar($id)
    {
    }

    function Deshabilitar($id)
    {
    }

    function Edit($entity)
    {
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
