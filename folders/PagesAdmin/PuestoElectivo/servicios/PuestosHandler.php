<?php


class PuestosHandler implements IDataBaseHandler
{

    private $connection;

    function __construct($directory)
    {
        $this->connection = new databaseConnection($directory);
    }

    function getAll()
    {

        $tableList = array();

        $stm = $this->connection->db->prepare('Select * FROM Puestos');
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return $tableList;
        } else {
            while ($row = $result->fetch_object()) {
                $user = new Puestos();

                $user->id_puesto = $row->id_puesto;
                $user->nombre = $row->nombre;
                $user->descripcion = $row->descripcion;
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

        $stm = $this->connection->db->prepare('Select * FROM Puestos WHERE estado = true');
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return $tableList;
        } else {
            while ($row = $result->fetch_object()) {
                $user = new Puestos();

                $user->id_puesto = $row->id_puesto;
                $user->nombre = $row->nombre;
                $user->descripcion = $row->descripcion;
                $user->estado = $row->estado;

                array_push($tableList, $user);
            }

            $stm->close();
            return $tableList;
        }
    }

    function getInactive()
    {

        $tableList = array();

        $stm = $this->connection->db->prepare('Select * FROM Puestos WHERE estado = false');
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return $tableList;
        } else {
            while ($row = $result->fetch_object()) {
                $user = new Puestos();

                $user->id_puesto = $row->id_puesto;
                $user->nombre = $row->nombre;
                $user->descripcion = $row->descripcion;
                $user->estado = $row->estado;

                array_push($tableList, $user);
            }

            $stm->close();
            return $tableList;
        }
    }

    function getById($id)
    {
        $stm = $this->connection->db->prepare('Select * FROM Puestos where id_puesto = ?');
        $stm->bind_param('i', $id);
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return null;
        } else {

            $row = $result->fetch_object();
            $user = new Puestos();

            $user->id_puesto = $row->id_puesto;
            $user->nombre = $row->nombre;
            $user->descripcion = $row->descripcion;
            $user->estado = $row->estado;

            $stm->close();
            return $user;
        }
    }

    function Add($entity)
    {
        $stm = $this->connection->db->prepare('insert into Puestos(nombre,descripcion) VALUES(?,?)');
        $stm->bind_param('ss', $entity->nombre, $entity->descripcion);
        $stm->execute();
    }

    function Habilitar($id)
    {
        $stm = $this->connection->db->prepare('update Puestos set estado = true where id_puesto = ?');
        $stm->bind_param('i', $id);
        $stm->execute();
    }

    function Deshabilitar($id)
    {
        $stm = $this->connection->db->prepare('update Puestos set estado = false where id_puesto = ?');
        $stm->bind_param('i', $id);
        $stm->execute();
    }

    function Edit($entity)
    {
        $stm = $this->connection->db->prepare('update Puestos set nombre = ?, descripcion = ? where id_puesto = ?');
        $stm->bind_param('ssi', $entity->nombre, $entity->descripcion, $entity->id_puesto);
        $stm->execute();
    }

}
