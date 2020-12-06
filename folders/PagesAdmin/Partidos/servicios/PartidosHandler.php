<?php

require_once '../../../databaseHandler/databaseConnection.php';
require_once '../../../iDataBase/IDatabase.php';

class PartidosHandler implements IDataBaseHandler
{

    private $connection;

    function __construct($directory)
    {
        $this->connection = new databaseConnection($directory);
    }

    function getAll()
    {

        $tableList = array();

        $stm = $this->connection->db->prepare('Select * FROM Partidos');
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return $tableList;
        } else {
            while ($row = $result->fetch_object()) {
                $user = new Partidos();

                $user->id_partido = $row->id_partido;
                $user->nombre = $row->nombre;
                $user->descripcion = $row->descripcion;
                $user->logo = $row->logo;
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

        $stm = $this->connection->db->prepare('Select * FROM Partidos WHERE estado = true');
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return $tableList;
        } else {
            while ($row = $result->fetch_object()) {
                $user = new Partidos();

                $user->id_partido = $row->id_partido;
                $user->nombre = $row->nombre;
                $user->descripcion = $row->descripcion;
                $user->logo = $row->logo;
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
        $tableList = array();

        $stm = $this->connection->db->prepare('Select * FROM Partidos where id_partido = ?');
        $stm->bind_param('i', $id);
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return $tableList;
        } else {
            $row = $result->fetch_object(); 
            $user = new Partidos();

            $user->id_partido = $row->id_partido;
            $user->nombre = $row->nombre;
            $user->descripcion = $row->descripcion;
            $user->logo = $row->logo;
            $user->estado = $row->estado;
            
            $stm->close();
            return $user;
        }
    }

    function Add($entity)
    {

        if (isset($_FILES['logo'])) {
            $logo = $_FILES['logo'];

            if ($logo['error'] == 4) {
                $entity->logo = "";
            } else {

                $typeReplace = str_replace("image/", "", $_FILES['logo']['type']);
                $type = $logo['type'];
                $size = $logo['size'];
                $name = $entity->nombre . '.' . $typeReplace;
                $timeFile = $logo['tmp_name'];

                $sucess = $this->uploadImage('../../../assets/images/partidos/', $name, $timeFile, $type, $size);

                if ($sucess) {

                    $entity->logo = $name;
                }
            }
        }

        $stm = $this->connection->db->prepare('insert into Partidos(nombre,descripcion,logo) VALUES(?,?,?)');
        $stm->bind_param('sss', $entity->nombre, $entity->descripcion, $entity->logo);
        $stm->execute();
    }

    function Habilitar($id)
    {
        $stm = $this->connection->db->prepare('update Partidos set estado = true where id_partido = ?');
        $stm->bind_param('i', $id);
        $stm->execute();

        $stm = $this->connection->db->prepare('update Candidatos set estado = true where id_partido = ?');
        $stm->bind_param('i', $id);
        $stm->execute();
    }

    function Deshabilitar($id)
    {
        $stm = $this->connection->db->prepare('update Partidos set estado = false where id_partido = ?');
        $stm->bind_param('i', $id);
        $stm->execute();

        $stm = $this->connection->db->prepare('update Candidatos set estado = false where id_partido = ?');
        $stm->bind_param('i', $id);
        $stm->execute();
    }

    function Edit($entity)
    {

        if (isset($_FILES['logo'])) {
            $logo = $_FILES['logo'];

            if ($logo['error'] == 4) {
                $entity->logo = "";
            } else {

                $typeReplace = str_replace("image/", "", $_FILES['logo']['type']);
                $type = $logo['type'];
                $size = $logo['size'];
                $name = $entity->nombre . '.' . $typeReplace;
                $timeFile = $logo['tmp_name'];

                $sucess = $this->uploadImage('../../../assets/images/partidos/', $name, $timeFile, $type, $size);

                if ($sucess) {

                    $entity->logo = $name;
                }
            }
        }

        $stm = $this->connection->db->prepare('update partidos set nombre = ?, descripcion = ?, logo = ? where id_partido = ?');
        $stm->bind_param('sssi', $entity->nombre, $entity->descripcion, $entity->logo, $entity->id_partido);
        $stm->execute();
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
