<?php



class EleccionesHandler implements IDataBaseHandler
{

    private $connection;

    function __construct($directory)
    {
        $this->connection = new databaseConnection($directory);
    }

    function getAll()
    {

        $tableList = array();

        $stm = $this->connection->db->prepare('Select * FROM Elecciones');
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return $tableList;
        } else {
            while ($row = $result->fetch_object()) {
                $user = new Elecciones();

                $user->id_elecciones = $row->id_elecciones;
                $user->nombre = $row->nombre;
                $user->fecha = $row->fecha;
                $user->estado = $row->estado;

                array_push($tableList, $user);
            }

            $stm->close();
            return $tableList;
        }
    }

    function getEleccionesCandidates($idElecciones)
    {

        $tableList = array();

        $stm = $this->connection->db->prepare('Select distinct(id_candidato) FROM Elecciones_cont WHERE id_elecciones = ?');
        $stm->bind_param('i', $idElecciones);
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return $tableList;
        } else {
            while ($row = $result->fetch_object()) {
                $user = new EleccionesAuditoria();

                $user->id_candidato = $row->id_candidato;

                array_push($tableList, $user);
            }

            $stm->close();
            return $tableList;
        }
    }

    function getEleccionesPartidos($idElecciones, $idCandidato)
    {

        $tableList = array();

        $stm = $this->connection->db->prepare('Select distinct(id_partido) FROM Elecciones_cont WHERE id_elecciones = ? and id_candidato = ?');
        $stm->bind_param('ii', $idElecciones, $idCandidato);
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return $tableList;
        } else {
            while ($row = $result->fetch_object()) {
                $user = new EleccionesAuditoria();

                $user->id_partido = $row->id_partido;

                array_push($tableList, $user);
            }

            $stm->close();
            return $tableList;
        }
    }
    function getEleccionesContByID($idElecciones)
    {

        $stm = $this->connection->db->prepare('Select count(*) as total FROM Elecciones_cont WHERE id_elecciones = ?');
        $stm->bind_param('i', $idElecciones);
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return false;
        } else {
            $row = $result->fetch_object();
            $user = new EleccionesAuditoria();

            $user->total = $row->total;

            $stm->close();
            return $user;
        }
    }

    function getEleccionesPuestos($idElecciones, $idCandidato)
    {

        $tableList = array();

        $stm = $this->connection->db->prepare('Select distinct(id_puesto) FROM Elecciones_cont WHERE id_elecciones = ? and id_candidato = ?');
        $stm->bind_param('ii', $idElecciones, $idCandidato);
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return $tableList;
        } else {
            while ($row = $result->fetch_object()) {
                $user = new EleccionesAuditoria();

                $user->id_puesto = $row->id_puesto;

                array_push($tableList, $user);
            }

            $stm->close();
            return $tableList;
        }
    }

    function getEleccionesPuestosByCondition($idElecciones,$cedula,$id_puesto)
    {

        $stm = $this->connection->db->prepare('Select id_puesto,cedula FROM Elecciones_cont WHERE id_elecciones = ? and cedula = ? and id_puesto = ?');
        $stm->bind_param('isi', $idElecciones, $cedula, $id_puesto);
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return false;
        } else {

            $row = $result->fetch_object();
            $user = new EleccionesAuditoria();

            $user->id_puesto = $row->id_puesto;
            $user->cedula = $row->cedula;
        
            $stm->close();
            return $user;
        }
    }


    function FilterPuesto($cedula,$idElecciones,$listaPuestos) {

        foreach($listaPuestos as $key => $list) {
            $filter = $this->getEleccionesPuestosByCondition($idElecciones,$cedula,$list->id_puesto);
            if($filter == true) {
                unset($listaPuestos[$key]);
                array_values($listaPuestos);
            }
        }
        return $listaPuestos;
    }

    function getEleccionesVotoTotal($idElecciones, $idCandidato)
    {

        $stm = $this->connection->db->prepare('Select count(*) as total FROM Elecciones_cont WHERE id_elecciones = ? and id_candidato = ? ORDER BY total DESC');
        $stm->bind_param('ii', $idElecciones, $idCandidato);
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return false;
        } else {
            $row = $result->fetch_object();
            $user = new EleccionesAuditoria();

            $user->total = $row->total;

            $stm->close();

            return $user;
        }
    }

    function getActive()
    {
    }

    function getInactive()
    {
    }

    function getById($id)
    {
        $tableList = array();

        $stm = $this->connection->db->prepare('Select * FROM Elecciones WHERE id_elecciones = ?');
        $stm->bind_param('i', $id);
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return $tableList;
        } else {
            $row = $result->fetch_object();
            $user = new Elecciones();

            $user->id_elecciones = $row->id_elecciones;
            $user->nombre = $row->nombre;
            $user->fecha = $row->fecha;
            $user->estado = $row->estado;


            $stm->close();
            return $user;
        }
    }

    function getByName($name)
    {
        $tableList = array();

        $stm = $this->connection->db->prepare('Select * FROM Elecciones WHERE nombre = ?');
        $stm->bind_param('s', $name);
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return $tableList;
        } else {
            $row = $result->fetch_object();
            $user = new Elecciones();

            $user->id_elecciones = $row->id_elecciones;
            $user->nombre = $row->nombre;
            $user->fecha = $row->fecha;
            $user->estado = $row->estado;


            $stm->close();
            return $user;
        }
    }

    function Add($entity)
    {
        $stm = $this->connection->db->prepare('insert into Elecciones(nombre) VALUES(?)');
        $stm->bind_param('s', $entity);
        $stm->execute();

        $ultimateId = $this->connection->db->insert_id;
        header('Location: ../vistas/iniciarElecciones.php?ultimate_id=' . $ultimateId);
    }

    function AddAuditoria($idElecciones,$id_candidato,$id_partido,$id_puesto,$cedula)
    {
        $stm = $this->connection->db->prepare('insert into Elecciones_cont VALUES(?,?,?,?,?)');
        $stm->bind_param('iiiis', $idElecciones,$id_candidato,$id_partido,$id_puesto,$cedula);
        $stm->execute();

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
}
